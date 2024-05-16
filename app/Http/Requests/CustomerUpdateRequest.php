<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'email' => ['required', ],
            'phone' => ['required', ],
            'mobile' => ['string' ],
            'name' => ['required','string'],
            'image' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'status' => ['required','in:0,1'],
            'country_id' => ['nullable','exists:countries,id'],
            'city_id' => ['nullable','exists:countries,id'],
            'area' => ['nullable','string'],
            'address' => ['nullable','string'],
            'street' => ['nullable','string'],
            'zip_code' => ['nullable','string'],
            'website' => ['nullable','url'],
            'note' => ['nullable'],
             'contact.*.name' => ['string'],
            // 'contact.*.position' => [ 'string'],
            //  'contact.*.email' => [ 'email', 'unique:customer_contacts'],
             'contact.*.email' => [ 'email'],
            // 'contact.*.phone' => ['numeric'],
            // 'contact.*.mobile' => ['numeric'],
             'contact.*.password' => ['string','nullable'],
       
        ];
    }
}
