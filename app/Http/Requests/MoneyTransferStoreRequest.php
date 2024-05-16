<?php

namespace App\Http\Requests;

use App\Rules\WalletAddressRule;
use Illuminate\Foundation\Http\FormRequest;

class MoneyTransferStoreRequest extends FormRequest
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
            'amount' => ['numeric'],
            'wallet_address' => ['required' ,'string', new WalletAddressRule],
        ];
    }
}
