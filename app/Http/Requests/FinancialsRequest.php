<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinancialsRequest extends FormRequest
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
            'financial_section_id'  => 'required',
            'name'                  => 'required',
            'pdf'                   => 'required|mimes:pdf',
            'cover_image'           => 'mimes:png,jpg,jpeg'
        ];
    }
}
