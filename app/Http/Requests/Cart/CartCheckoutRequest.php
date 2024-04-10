<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CartCheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_first_name' => ['required', 'string'],
            'customer_last_name' => ['required', 'string'],
            'customer_address' => ['required', 'string'],
            'customer_country' => ['required', 'string'],
            'customer_state' => ['required', 'string'],
            'customer_postal_code' => ['required', 'string'],

            'cc_number' => ['required', 'digits:16'],
            'cc_expiration_date' => ['required', 'string', 'regex:/^(0[1-9]|1[1-2])\/?([0-9]{2})$/'],
            'cc_cvv' => ['required', 'digits:3'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_first_name.required' => 'First name is required',
            'customer_last_name.required' => 'Last name is required',
            'customer_address.required' => 'Address is required',
            'customer_country.required' => 'Country is required',
            'customer_state.required' => 'State is required',
            'customer_postal_code.required' => 'Postal code is required',

            'cc_number.required' => 'Credit card number is required',
            'cc_number.digits' => 'Credit card number must be 16 digits',
            'cc_expiration_date.required' => 'Expiration date is required',
            'cc_cvv.required' => 'CVV is required',
            'cc_cvv.digits' => 'CVV must be 3 digits',
        ];
    }
}
