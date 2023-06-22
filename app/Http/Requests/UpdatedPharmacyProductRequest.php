<?php

namespace App\Http\Requests;


class UpdatedPharmacyProductRequest extends CustomFormRequest
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
            'product_price'    => 'required|min:0,01|max:99999999,99',
            'product_quantity' => 'required|numeric',
        ];
    }
}
