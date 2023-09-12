<?php

namespace App\Services\Order;

use App\Dto\Api\V1\Order\OrderCreateDto;
use App\Exceptions\MissingCartProductsItemsException;
use App\Models\DeliveryStatus;
use App\Models\Order;
use App\Models\PaymentStatus;
use App\Models\Product;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class OrderService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param OrderCreateDto $orderCreateDto
     * @return Builder|Model
     * @throws MissingCartProductsItemsException
     */
    public function create(OrderCreateDto $orderCreateDto)
    {
        if(!$cartProducts = $this->userRepository->getCartProducts(auth()->id())) {
            throw new MissingCartProductsItemsException();
        }

        /**
         * @var Order $order
         */
        $order = $this->createNewOrder($cartProducts, $orderCreateDto);

        $this->attachProductsFromCartToOrder($cartProducts, $order);

        $this->createNewOrderInfo($orderCreateDto, $order);

        return $order;
    }


    protected function createNewOrderInfo(OrderCreateDto $orderCreateDto, Order $order) : void
    {
        $order->info()->create([
            'user_name' => $orderCreateDto->getUserName(),
            'phone' => $orderCreateDto->getPhone(),
            'email' => $orderCreateDto->getEmail(),
            'city' => $orderCreateDto->getCity(),
            'provider' => $orderCreateDto->getProvider(),
            'department' => $orderCreateDto->getDepartment(),
            'delivery_address' => $orderCreateDto->getDeliveryAddress() ?? null,
            'comment' => $orderCreateDto->getComment() ?? null
        ]);
    }

    protected function createNewOrder(Collection $cartProducts, OrderCreateDto $orderCreateDto)
    {
        return Order::query()->create([
            'user_id' => auth()->id(),
            'order_status_id' => Order::STATUS_NEW,
            'payment_status_id' => PaymentStatus::STATUS_AWAITING,
            'payment_id' => $orderCreateDto->getPayment(),
            'delivery_status_id' => DeliveryStatus::STATUS_NOT_SHIPPED,
            'total_price' => $this->calculateTotalPrice($cartProducts)
        ]);
    }

    /**
     * @param Collection $cartProducts
     * @return Collection
     */
    protected function calculateTotalPrice(Collection $cartProducts): Collection
    {
        return $cartProducts->sum(function ($product) {
            if ($product->promotional_price) {
                return $product->promotional_price * $product->pivot->amount;
            }
            return $product->price * $product->pivot->amount;
        });
    }

    /**
     * @param Collection $cartProducts
     * @param Order $order
     */
    protected function attachProductsFromCartToOrder(Collection $cartProducts,Order $order)
    {
        $cartProducts->each(function ($product) use ($order) {
            $order->products()->attach($product->id, [
                'amount' => $product->pivot->amount,
                'price' => $this->productPrice($product)
            ]);
        });
    }

    /**
     * @param Product $product
     * @return float|int
     */
    protected function productPrice(Product $product)
    {
        if ($product->promotional_price) {
            return $product->promotional_price * $product->pivot->amount;
        }
        return $product->price * $product->pivot->amount;
    }
}
