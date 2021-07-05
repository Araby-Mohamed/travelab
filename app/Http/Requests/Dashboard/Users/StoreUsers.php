<?php

namespace App\Http\Requests\Dashboard\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class StoreUsers extends FormRequest
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
            'username' => 'required|max:191|min:3',
            'phone' => [
                'required',
                'email',
                'max:191',
                Rule::unique('admins', 'email')->ignore($this->route('id'))
            ],
            'password' => [
                'nullable',
                'min:6',
                'max:191',
                Rule::requiredIf(function() {
                    return Request::routeIs('dashboard.admins.store');
                })
            ],
            'date_of_birth' => 'required|min:3|max:20',
            'gender' => 'required|digit:1',
            'interests' => 'required|min:3',
            'currency_id' => 'required|integer',
            'image' => 'nullable|mimes:jpeg,jpg,png',
        ];
    }
}
