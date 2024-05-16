<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'email' => 'required|email',
            'phone' => ['required', 'string'],
            // , 'unique:customers,phone,NULL,NULL,deleted_at,NULL'],
            'mobile' => ['required', 'string'],
            // , 'unique:customers,mobile,NULL,NULL,deleted_at,NULL'],
            'name' => ['required','string'],
            // 'birth_date' => ['required', 'date', 'before:today'],
            'image' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'status' => ['required','in:0,1'],
            'country_id' => ['nullable','exists:countries,id'],
            'city_id' => ['nullable','exists:countries,id'],
            'area' => ['nullable','string'],
            'address' => ['nullable','string'],
            'street' => ['nullable','string'],
            'website' => ['nullable','url'],
            'note' => ['nullable'],
            'zip_code' => ['nullable','string'],
            // 'contact.*.name' => ['string'],
            // 'contact.*.position' => [ 'string'],
            //  'contact.*.email' => [ 'email', 'unique:customer_contacts'],
            // 'contact.*.phone' => ['numeric,unique:customer_contacts,phone,NULL,NULL,deleted_at,NULL'],
            // 'contact.*.mobile' => ['numeric,unique:customer_contacts,mobile,NULL,NULL,deleted_at,NULL'],
            // 'contact.*.password' => ['string'],
        ];
        
    }
}
