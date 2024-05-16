<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeveloperStoreRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:customers,email,NULL,NULL,deleted_at,NULL'],
            'phone' => ['required', 'string', 'unique:customers,phone,NULL,NULL,deleted_at,NULL'],
            'mobile' => ['required', 'string', 'unique:customers,mobile,NULL,NULL,deleted_at,NULL'],
            'notes' => ['nullable','string'],
            'status' => ['required','in:0,1'],
            'image' => [ 'image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'country_id' => ['nullable','exists:countries,id'],
            'city_id' => ['nullable','exists:countries,id'],
            'area' => ['nullable','string'],
            'address' => ['nullable','string'],
            'street' => ['nullable','string'],
            'gps' => ['nullable','string'],
            'zip_code' => ['nullable','string'],
        ];
    }
}
