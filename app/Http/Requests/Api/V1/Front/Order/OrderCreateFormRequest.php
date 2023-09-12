<?php

namespace App\Http\Requests\Api\V1\Front\Order;

use App\Dto\Api\V1\Order\OrderCreateDto;
use App\Models\DeliveryProvider;
use App\Models\Payment;
use App\Rules\ValidatePhoneRule;
use Illuminate\Foundation\Http\FormRequest;


class OrderCreateFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_name' => 'required|max:100',
            'phone' => ['required', 'max:13', new ValidatePhoneRule()],
            'city' => 'required|max:100',
            'provider' => ['required', 'max:100', 'exists:' . DeliveryProvider::class . ',id'],
            'department' => 'required|max:100',
            'payment' => 'required|exists:' . Payment::class . ',id',
            'delivery_address' => 'nullable|max:190',
            'email' => 'nullable|email|max:190',
            'comment' => 'nullable',
        ];
    }

    /**
     * @return OrderCreateDto
     */
    public function getDto(): OrderCreateDto
    {
        return new OrderCreateDto(
            user_name: $this->validated('user_name'),
            phone: $this->validated('phone'),
            provider: $this->validated('provider'),
            city: $this->validated('city'),
            department: $this->validated('department'),
            payment: $this->validated('payment'),
            delivery_address: $this->validated('delivery_address'),
            comment: $this->validated('comment'),
            email: $this->validated('email')
        );
    }
}
