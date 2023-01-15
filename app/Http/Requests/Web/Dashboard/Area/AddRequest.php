<?php

namespace App\Http\Requests\Web\Dashboard\Area;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
            'area' => ['required'],
        ];
    }

    public function messages()
    {
        return [
          'area.required' => trans('area name field is required'),
        ];
    }
}
