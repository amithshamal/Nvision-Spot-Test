<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Helpers\Helper;
use Illuminate\Contracts\Validation\Validator;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'customer_name' => 'required|string|max:255',
            'order_value' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'order_status'=> 'required'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        Helper::sendError('Request validation error', $validator->errors());
    }
}
