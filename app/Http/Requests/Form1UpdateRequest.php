<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Form1UpdateRequest extends FormRequest
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
            'purchase_order' => ['string'],
            'truck_Av_load_weight' => ['nullable'],
        ];
    }
}
