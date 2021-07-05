<?php

namespace App\Http\Requests\Dashboard\Governorate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class Store extends FormRequest
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
        $id = $this->route('co');
        return [
            'title' => [
                'required',
                'min:3',
                'max:191',
                Rule::unique('governorate')->where(function ($query) use($id) {
                    return $query->where('country_id', $id)
                        ->where('title', request()->title);
                })->ignore($this->route('id')),
            ],
        ];
    }
}
