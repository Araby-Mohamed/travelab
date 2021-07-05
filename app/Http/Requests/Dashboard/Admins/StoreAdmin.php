<?php

namespace App\Http\Requests\Dashboard\Admins;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class StoreAdmin extends FormRequest
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
            'email' => [
                'required',
                'email',
                'max:191',
                Rule::unique('admins', 'email')->ignore($this->route('id'))
            ],
            'phone' => [
                'required',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'max:20',
                Rule::unique('admins', 'phone')->ignore($this->route('id'))
            ],
            'password' => [
                'nullable',
                'min:6',
                'max:191',
                Rule::requiredIf(function() {
                    return Request::routeIs('dashboard.admins.store');
                })
            ],
            'image' => 'nullable|mimes:jpeg,jpg,png',
            'role' => 'required|integer',
        ];
    }
}
