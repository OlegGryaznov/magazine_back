<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Exceptions\MissingCartProductsItemsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Front\Order\OrderCreateFormRequest;
use App\Http\Resources\Api\V1\Front\Order\OrderResource;
use App\Models\Order;
use App\Services\Order\OrderService;
use App\Traits\LogTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class OrderController extends Controller
{
    use LogTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::query()
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(config('paginate.orders'));

        return OrderResource::collection($orders);
    }

    /**
     * @param OrderCreateFormRequest $request
     * @param OrderService $orderService
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(OrderCreateFormRequest $request, OrderService $orderService)
    {
        try {
            DB::beginTransaction();
            $orderService->create($request->getDto());
            DB::commit();

            return response()->json(
                [
                    'message' => 'Order created'
                ],
                Response::HTTP_CREATED
            );
        } catch (MissingCartProductsItemsException $exception) {
            $this->log($exception);

            DB::rollBack();

            return response()->json(
                [
                    'message' => 'Missing cart products items'
                ],
                Response::HTTP_BAD_REQUEST
            );
        } catch (\Exception $exception) {
            $this->log($exception);

            DB::rollBack();

            return response()->json(
                [
                    'message' => 'Server error'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


}
