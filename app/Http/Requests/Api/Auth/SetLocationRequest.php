<?php

namespace App\Http\Requests\Api\Auth;

use App\Traits\ApiTraits;
use Illuminate\Foundation\Http\FormRequest;

class SetLocationRequest extends FormRequest
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
            "areas_id"   => "required|array|min:1",
            "areas_id.*" => "exists:areas,id",
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response =  $this->responseJsonFailedValidate($validator->errors());
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
