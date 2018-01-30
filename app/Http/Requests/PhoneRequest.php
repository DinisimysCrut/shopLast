<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneRequest extends FormRequest
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
            'phone' => 'required|digits:9'
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => trans('my_validation.required',['name' => trans('all.phone')]),
            'phone.digits' => trans('my_validation.digits',['name' => trans('all.phone')])
        ];
    }
}
