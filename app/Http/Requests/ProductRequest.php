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
            'name'=>'required|between:5,300',
            'about'=>'required|between:20,5000',
            'price'=>'required|numeric|min:0',
            'images.*'=>'image|max:12000'
        ];

    }

    public function messages()
    {
        return array_dot([
            'name' => [
                'between' => trans('my_validation.between',['name' => trans('products.name')]),
                'required' => trans('my_validation.required',['name' => trans('products.name')]),
            ],
            'about' => [
                'between' => trans('my_validation.between',['name' => trans('products.about')]),
                'required' => trans('my_validation.required',['name' => trans('products.about')]),
            ],
            'price' => [
                'required' => trans('my_validation.required',['name' => trans('products.price')]),
                'numeric' => trans('my_validation.numeric',['name' => trans('products.price')]),
                'min' => trans('my_validation.min',['name' => trans('products.price')])
            ],
            'images.*' => [
                'image' => trans('my_validation.image'),
                'max' => trans('my_validation.image_max')
            ]

        ]);
    }
}
