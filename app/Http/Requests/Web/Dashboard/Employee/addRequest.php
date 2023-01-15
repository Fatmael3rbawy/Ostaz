<?php

namespace App\Http\Requests\Web\Dashboard\Employee;

use Illuminate\Foundation\Http\FormRequest;

class addRequest extends FormRequest
{
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
            'name' => ['required', 'min:2', 'max:250'],
            'image' => ['nullable','image', 'mimes:png,jpg,jepg' , 'max:2000'],
            'email' => ['required','unique:users,email'],
            'role' => ['required', 'exists:roles,id'],
        ];
    }

    public function messages()
    {
        return [
          'name.required' => trans('name is required'),
          'name.min' => trans('minmum number of charchters is 2'),
          'name.max' => trans('maxmum number of charchters is 250'),
          'image.image' => trans('avatar should be image'),
          'image.mimes' => trans('avatar image type not allowed'),
          'image.max' => trans('file too large'),
          'email.required' => trans('email is required'),
          'email.unique' => trans('this email alerady taken'),
          'role.required' => trans('role is required'),
          'role.exists' => trans('role is not correct'),
        ];
    }
}
