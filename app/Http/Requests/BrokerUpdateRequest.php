<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrokerUpdateRequest extends FormRequest
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
            'email' => ['required', 'email', 'unique:brokers,email,'.$this->broker->id.',id,deleted_at,NULL'],
            'phone' => ['required', 'string', 'unique:brokers,phone,'.$this->broker->id.',id,deleted_at,NULL'],
            'mobile' => ['required', 'string', 'unique:brokers,mobile,'.$this->broker->id.',id,deleted_at,NULL'],
            'name' => ['required','string'],
            'image' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'status' => ['required','in:0,1'],
            'is_verified' => ['required','in:0,1'],
            'country_id' => ['nullable','exists:countries,id'],
            'city_id' => ['nullable','exists:countries,id'],
            'area' => ['nullable','string'],
            'address' => ['nullable','string'],
            'street' => ['nullable','string'],
            'gps' => ['nullable','string'],
            'brief' => ['nullable','string'],
            'zip_code' => ['nullable','string'],
            'wallet_in' => ['required', 'numeric','min:0', 'max:100'],
            'wallet_out' => ['required', 'numeric','min:0', 'max:100'],
            'shares_buying' => ['required', 'numeric', 'min:0', 'max:100'],
            'shares_selling' => ['required', 'numeric', 'min:0', 'max:100'],
            
        ];
    }
}
