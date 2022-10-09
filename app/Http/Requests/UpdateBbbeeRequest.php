<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBbbeeRequest extends FormRequest
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
            'name' => ['min:3', Rule::unique('bbbees')->ignore($this->bbbee->id) ],
            'slug' => [Rule::unique('bbbees')->ignore($this->bbbee->id) ],
        ];
    }
}
