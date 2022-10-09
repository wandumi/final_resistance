<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortifolioRequest extends FormRequest
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
            'lists'             => 'required|numeric',
            'numberOfShares'    => 'required|numeric',
            'perIssueShared'    => 'required|numeric',
            'cover_image'       => 'required|mimes:jpg,png,jpeg',
        ];
    }
}
