<?php

namespace App\Http\Requests\Web\Dashboard\Role;

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
        $id = $this->route('role');
        return [
            'name' => ['required', 'unique:roles,name,'.$id],
        ];
    }

    public function messages()
    {
        return [
          'name.required' => trans('name field is required'),
          'name.unique' => trans('this name aleardy taken'),
        ];
    }
}
