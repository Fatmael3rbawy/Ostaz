<?php

namespace App\Http\Requests\Web\Dashboard\AppSetting;

use Illuminate\Foundation\Http\FormRequest;

class editRequest extends FormRequest
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
            'welcome_message' => ['required'],
        ];
    }

    public function messages()
    {
        return [
          'welcome_message.required' => trans('welcome message is required'),
        ];
    }
}
