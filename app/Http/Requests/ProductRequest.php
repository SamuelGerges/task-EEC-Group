<?php

namespace App\Http\Requests;


class ProductRequest extends CustomFormRequest
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

        $rules =  [
            'product_title' => 'required|max:100',
            'product_desc'  => 'required',
            'product_image' => 'required_without:product_id|mimes:jpg,jpeg,png',
        ];


        return $rules;
    }
}
