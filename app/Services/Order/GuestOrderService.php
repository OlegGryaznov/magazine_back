<?php

namespace App\Services\Order;

use App\Dto\Api\V1\Order\GuestOrderCreateDto;
use App\Models\DeliveryStatus;
use App\Models\Order;
use App\Models\PaymentStatus;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GuestOrderService
{
    /**
     * @param GuestOrderCreateDto $guestOrderCreateDto
     */
    public function create(GuestOrderCreateDto $guestOrderCreateDto): void
    {
        /**
         * Collection models from DB
         */
        $products = $this->getProductsList($guestOrderCreateDto->getProducts());

        /**
         * Collection models + field 'orderAmount'
         */
        $products = $this->addAmountToProducts($products, $guestOrderCreateDto->getProducts());

        /**
         * @var Order $order
         */
        $order = $this->createNewOrder($products, $guestOrderCreateDto);

        $this->createNewOrderInfo($order, $guestOrderCreateDto);

        $this->attachProductsToOrder($products, $order);
    }

    /**
     * @param Collection $products
     * @param GuestOrderCreateDto $guestOrderCreateDto
     * @return Builder|Model
     */
    protected function createNewOrder(Collection $products, GuestOrderCreateDto $guestOrderCreateDto): Builder|Model
    {
        return Order::query()->create([
            'order_status_id' => Order::STATUS_NEW,
            'payment_status_id' => PaymentStatus::STATUS_AWAITING,
            'payment_id' => $guestOrderCreateDto->getPayment(),
            'delivery_status_id' => DeliveryStatus::STATUS_NOT_SHIPPED,
            'total_price' => $this->calculateTotalPrice($products)
        ]);
    }

    /**
     * @param Order $order
     * @param GuestOrderCreateDto $guestOrderCreateDto
     * @return Model
     */
    protected function createNewOrderInfo(Order $order, GuestOrderCreateDto $guestOrderCreateDto)
    {
        return $order->info()->create([
            'user_name' => $guestOrderCreateDto->getUserName(),
            'phone' => $guestOrderCreateDto->getPhone(),
            'email' => $guestOrderCreateDto->getEmail(),
            'city' => $guestOrderCreateDto->getCity(),
            'department' => $guestOrderCreateDto->getDepartment(),
            'delivery_address' => $guestOrderCreateDto->getDeliveryAddress() ?? null,
            'comment' => $guestOrderCreateDto->getComment() ?? null,
            'provider' => $guestOrderCreateDto->getProvider()
        ]);
    }

    /**
     * @param array $products [ ... [productId, amount], ... ]
     * @return Collection
     */
    public function getProductsList(array $products): Collection
    {
        return Product::query()
            ->whereIn('id', array_column($products, 'productId'))
            ->active()
            ->get();
    }

    /**
     * @param Collection $products
     * @param array $extractedData
     * @return Collection
     */
    protected function addAmountToProducts(Collection $products, array $extractedData): Collection
    {
        $products->map(function ($product) use ($extractedData) {
            foreach ($extractedData as $value) {
                if ($product->id == $value['productId']) {
                    $product->orderAmount = $value['amount'];
                }
            }
            return $product;
        });

        return $products;
    }

    /**
     * @param Collection $products
     * @return Collection
     */
    protected function calculateTotalPrice(Collection $products): Collection
    {
        return $products->sum(function ($product) {
            if ($product->promotional_price) {
                return $product->promotional_price * $product->orderAmount;
            }
            return $product->price * $product->orderAmount;
        });
    }

    /**
     * @param Collection $products
     * @param Order $order
     */
    protected function attachProductsToOrder(Collection $products, Order $order): void
    {
        $products->each(function (Product $product) use ($order) {
            $order->products()->attach($product->id,
                [
                    'amount' => $product->orderAmount,
                    'price' => $this->productPrice($product)
                ]
            );
        });
    }

    /**
     * @param Product $product
     * @return float|int
     */
    protected function productPrice(Product $product): float|int
    {
        if ($product->promotional_price) {
            return $product->promotional_price * $product->orderAmount;
        }
        return $product->price * $product->orderAmount;
    }
}
