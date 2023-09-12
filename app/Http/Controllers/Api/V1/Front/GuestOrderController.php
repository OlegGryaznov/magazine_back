<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Front\Order\GuestOrderCreateRequest;
use App\Services\Order\GuestOrderService;
use App\Traits\LogTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class GuestOrderController extends Controller
{
    use LogTrait;

    /**
     * @param GuestOrderCreateRequest $request
     * @param GuestOrderService $guestOrderService
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(GuestOrderCreateRequest $request, GuestOrderService $guestOrderService): JsonResponse
    {
        try {
            DB::beginTransaction();
            $guestOrderService->create($request->getDto());
            DB::commit();
            return response()->json(['message' => 'Order created'], Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->log($exception);
            return response()->json(['message' => 'Server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
