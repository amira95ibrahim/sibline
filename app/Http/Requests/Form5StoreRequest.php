<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Form5StoreRequest extends FormRequest
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
            'coupon' => ['required','string'],
            'destination' => ['nullable','string'],
            'truck_license' => ['nullable','string'],
            'driver_phone'=>['number'],
            'driver_name'=>['string']

        ];
    }
}
