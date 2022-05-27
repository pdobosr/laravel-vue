<?php

namespace App\Http\Requests\Shippers;

use Illuminate\Foundation\Http\FormRequest;

class StoreShipperRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => 'required',
            'address' => 'required',
            'primary_contact_id' => 'required',
            'contact_ids' => 'required'
        ];
    }
}
