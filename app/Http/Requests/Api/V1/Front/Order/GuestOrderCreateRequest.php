<?php

namespace App\Http\Requests\Api\V1\Front\Order;

use App\Dto\Api\V1\Order\GuestOrderCreateDto;
use App\Models\DeliveryProvider;
use App\Models\Payment;
use App\Models\Product;
use App\Rules\ValidatePhoneRule;
use Illuminate\Foundation\Http\FormRequest;


class GuestOrderCreateRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'user_name' => 'required|max:100',
            'phone' => ['required', 'max:13', new ValidatePhoneRule()],
            'provider' => ['required', 'max:100', 'exists:' . DeliveryProvider::class . ',id'],
            'city' => 'required|max:100',
            'department' => 'required|max:100',
            'delivery_address' => 'nullable|max:190',
            'email' => 'nullable|email|max:190',
            'comment' => 'nullable',
            'products' => 'required',
            'products.*.productId' => 'numeric|exists:' . Product::class . ',id',
            'products.*.amount' => 'numeric',
            'payment' => 'required|exists:' . Payment::class . ',id'
        ];
    }

    /**
     * @return GuestOrderCreateDto
     */
    public function getDto(): GuestOrderCreateDto
    {
        return new GuestOrderCreateDto(
            user_name: $this->validated('user_name'),
            phone: $this->validated('phone'),
            provider: $this->validated('provider'),
            city: $this->validated('city'),
            department: $this->validated('department'),
            products: $this->validated('products'),
            payment: $this->validated('payment'),
            delivery_address: $this->validated('delivery_address'),
            email: $this->validated('email'),
            comment: $this->validated('comment'),
        );
    }
}
