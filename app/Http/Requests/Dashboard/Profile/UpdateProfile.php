<?php

namespace App\Http\Requests\Dashboard\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfile extends FormRequest
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
        $admin = auth('admin')->user()->id;
        return [
            'username' => 'required|max:191',
            'email' => [
                'required',
                'email',
                'max:191',
                Rule::unique('admins', 'email')->ignore($admin)
            ],
            'phone' => [
                'required',
                'max:191',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:10',
                Rule::unique('admins', 'phone')->ignore($admin)
            ],
            'password' => 'sometimes|max:191',
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
        ];
    }
}
