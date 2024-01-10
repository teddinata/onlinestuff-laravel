<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'province_id' => 'nullable|integer',
            'regency_id' => 'nullable|integer',
            'district_id' => 'nullable|integer',
            'village_id' => 'nullable|integer',
            'postal_code' => 'nullable|string|max:255',
            'courier' => 'nullable|string|max:255',
            'courier_service' => 'nullable|string|max:255',
            'insurance_price' => 'nullable|integer',
            'shipping_price' => 'nullable|integer',
            'total_amount' => 'nullable|integer',
            'payment_method' => 'nullable|string|max:255',
            'payment_status' => 'nullable|string|max:255',
            'shipping_status' => 'nullable|string|max:255',
            'estimated_arrival' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ];
    }
}
