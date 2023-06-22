<?php

namespace App\Http\Requests;


class PharmacyProductRequest extends CustomFormRequest
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
            'product_id'       => 'required_without:id|numeric|exists:products,product_id',
            'product_price'    => 'required|min:0,01|max:99999999,99',
            'product_quantity' => 'required|numeric',
        ];
    }
}
