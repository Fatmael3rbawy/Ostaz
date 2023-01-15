<?php

namespace App\Http\Requests\Api\Auth;

use App\Traits\ApiTraits;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use ApiTraits;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "email" => "required|email",
            "password" => "required",
            "device_token" => "required",
            "device_type" => "required|in:ios,android",
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response =  $this->responseJsonFailedValidate($validator->errors());
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
