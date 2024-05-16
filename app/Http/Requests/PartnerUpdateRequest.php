<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerUpdateRequest extends FormRequest
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
            'email' => ['required', 'email', 'unique:partners,email,'.$this->partner->id.',id,deleted_at,NULL'],
            'phone' => ['required', 'string', 'unique:partners,phone,'.$this->partner->id.',id,deleted_at,NULL'],
            'mobile' => ['required', 'string', 'unique:partners,mobile,'.$this->partner->id.',id,deleted_at,NULL'],
            'name' => ['required','string'],
            'website' => ['required', 'string'],
            'brief' => ['nullable','string'],
            'image' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'status' => ['required','in:0,1'],
            'is_verified' => ['required','in:0,1'],
            'country_id' => ['nullable','exists:countries,id'],
            'city_id' => ['nullable','exists:countries,id'],
            'area' => ['nullable','string'],
            'address' => ['nullable','string'],
            'street' => ['nullable','string'],
            'gps' => ['nullable','string'],
            'zip_code' => ['nullable','string'],
            'contact.*.name' => ['required', 'string'],
            'contact.*.position' => ['required', 'string'],
            'contact.*.email' => ['required', 'email'],
            'contact.*.phone' => ['required'],
            'contact.*.mobile' => ['required'],
            'wallet_in' => ['required', 'numeric','min:0', 'max:100'],
            'wallet_out' => ['required', 'numeric','min:0', 'max:100'],
            'shares_buying' => ['required', 'numeric', 'min:0', 'max:100'],
            'shares_selling' => ['required', 'numeric', 'min:0', 'max:100'],
        ];
    }
}
