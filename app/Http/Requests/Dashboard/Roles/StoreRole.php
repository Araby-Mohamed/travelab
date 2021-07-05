<?php

namespace App\Http\Requests\Dashboard\Roles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRole extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:191',
                Rule::unique('roles', 'name')->ignore($this->route('id'))
            ],
            'permissions' => 'required|array',
            'permissions.*' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('lang.role'),
            'display_name' => 'الدور',
            'permissions' => __('lang.permissions'),
        ];
    }
}
