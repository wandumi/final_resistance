<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertiesRequest extends FormRequest
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
            'pronvice_id'   => 'required',
            'name'          => 'required',
            'description'   => 'required',
            'website_link'  => 'required',
            'cover_image'   => 'required|mimes:png,jpg,jpeg',
            'banner_image'  => 'required|mimes:png,jpg,jpeg',
        ];
    }
}
