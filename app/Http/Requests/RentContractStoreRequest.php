<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentContractStoreRequest extends FormRequest
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
            'amount' => ['required', 'integer'],
            'rental_period' => ['required', 'integer'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
            'property_id' => ['required'],
            'partner_id' => ['required'],
            'partner_commission' => ['required'],
            'broker_commission' => ['required'],
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
            'nationality' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'mobile' => ['required', 'string'],

            // document validation
            'document.*.title' => ['required', 'string'],
            'document.*.url' => ['required'],

            
        ];
    }
}
