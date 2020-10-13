<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required|numeric',
        ];
    }

    public function messages() {
        return [
            'name.required'  => 'Please fill in the name fields',
            'price.required' => 'Please fill in the price fields',
            'price.numeric'    => 'Price must be numeric',
        ];
    }
}
