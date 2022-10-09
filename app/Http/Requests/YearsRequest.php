<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class YearsRequest extends FormRequest
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
            'year' => 'required|digits:4|integer|min:1900'
        ];
    }
}
