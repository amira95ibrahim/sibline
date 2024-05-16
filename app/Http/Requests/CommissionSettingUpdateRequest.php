<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommissionSettingUpdateRequest extends FormRequest
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
            'wallet_in_PARTNER' => ['required', 'numeric','min:0', 'max:100'],
            'wallet_out_PARTNER' => ['required', 'numeric','min:0', 'max:100'],
            'shares_buying_PARTNER' => ['required', 'numeric', 'min:0', 'max:100'],
            'shares_selling_PARTNER' => ['required', 'numeric', 'min:0', 'max:100'],
            'expense_PARTNER' => ['required', 'numeric', 'min:0', 'max:100'],

            'wallet_in_BROKER' => ['required', 'numeric','min:0', 'max:100'],
            'wallet_out_BROKER' => ['required', 'numeric','min:0', 'max:100'],
            'shares_buying_BROKER' => ['required', 'numeric', 'min:0', 'max:100'],
            'shares_selling_BROKER' => ['required', 'numeric', 'min:0', 'max:100'],
            'expense_BROKER' => ['required', 'numeric', 'min:0', 'max:100'],

            'wallet_in_SYSTEM' => ['required', 'numeric','min:0', 'max:100'],
            'wallet_out_SYSTEM' => ['required', 'numeric','min:0', 'max:100'],
            'wallet_transfer_SYSTEM' => ['required', 'numeric','min:0', 'max:100'],
            'shares_buying_SYSTEM' => ['required', 'numeric', 'min:0', 'max:100'],
            'shares_selling_SYSTEM' => ['required', 'numeric', 'min:0', 'max:100'],
            'expense_SYSTEM' => ['required', 'numeric', 'min:0', 'max:100'],
            
        ];
    }
}
