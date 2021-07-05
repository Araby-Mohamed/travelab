<?php

namespace App\Http\Requests\Dashboard\Meta;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMeta extends FormRequest
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
            'image' => [
                'nullable',
                'mimes:jpeg,jpg,png'
            ],
            'en.title' => 'required|string|max:191',
            'en.keywords' => 'required',
            'en.description' => 'required',
            'ar.title' => 'required|string|max:191',
            'ar.keywords' => 'required',
            'ar.description' => 'required',
        ];
    }
}
