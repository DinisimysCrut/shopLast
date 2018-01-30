<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountProductRequest extends FormRequest
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
            'count'=>'required|integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'count.required' => trans('my_validation.required',['name' => trans('products.count')]),
            'count.integer' => trans('my_validation.integer',['name' => trans('products.count')]),
            'count.min' => trans('my_validation.min',['name' => trans('products.count')])
        ];
    }
}
