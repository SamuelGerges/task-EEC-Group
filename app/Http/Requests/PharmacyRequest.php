<?php

namespace App\Http\Requests;


class PharmacyRequest extends CustomFormRequest
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
            'pharmacy_name'    => 'required|string',
            'pharmacy_address' => 'required|string',
        ];
    }
}
