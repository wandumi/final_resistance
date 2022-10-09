<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertiesRequest extends FormRequest
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
            'pronvice_id'   => 'Required',
            'name'          => ['required','min:3'],
            'description'   => 'Required',
            'website_link'  => 'Required',
            'cover_image'   => ['mimes:png,jpg,jpeg', Rule::unique('properties')->ignore($this->property->cover_image)],
        ];
    }
}
