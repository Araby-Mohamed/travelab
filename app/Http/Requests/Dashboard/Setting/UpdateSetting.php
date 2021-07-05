<?php

namespace App\Http\Requests\Dashboard\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSetting extends FormRequest
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
            'site_name' => 'required|string|max:191',
            'address' => 'nullable|string|max:191',
            'copyright' => 'required|string|max:191',
            'copyright_link_text' => 'nullable|string|max:191',
            'copyright_link' => 'nullable|url|max:191',
            'sm_description' => 'required|string|max:191',
            'phone_1' => 'required|max:191|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'phone_2' => 'nullable|max:191|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'email_1' => 'required|string|email|max:191',
            'email_2' => 'nullable|string|email|max:191',
            'location' => 'nullable|url|max:191',
            'facebook' => 'nullable|url|max:191',
            'twitter' => 'nullable|url|max:191',
            'instagram' => 'nullable|url|max:191',
            'snapchat' => 'nullable|url|max:191',
            'pinterest' => 'nullable|url|max:191',
            'youtube' => 'nullable|url|max:191',
            'logo' => 'nullable|mimes:jpeg,jpg,png',
            'favicon' => 'nullable|mimes:jpeg,jpg,png',
        ];
    }
}
