<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentStoreRequest extends FormRequest
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
            'date' => ['required','date'],
            'amount' => ['required','integer'],
            'partner_id' => ['required_without:broker_id','exists:partners,id'],
            'broker_id' => ['required_without:partner_id','exists:brokers,id'],
            'document' => ['nullable'],
        ];
    }
}
