<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Helpers\Helper;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "email" => "required|string|email",
            "password" => "required"
        ];
    }

    public function failedValidation(Validator $validator){
        Helper::sendError('Request validation error',$validator->errors());
    }
}
