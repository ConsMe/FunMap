<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPoint extends FormRequest
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
            'lat' => 'required|numeric|between:-89.99,89.99',
            'lng' => 'required|numeric|between:-179.99,179.99',
            'category_id' => 'required|exists:categories,id',
            'comment' => 'string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'lat.numeric' => 'The format of latitude is wrong',
            'lat.between' => 'The format of latitude is wrong',
            'lng.numeric' => 'The format of longitude is wrong',
            'lng.between' => 'The format of longitude is wrong',
            'comment.max'  => 'The comment must be less then 255 symbols'
        ];
    }
}
