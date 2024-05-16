<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailUpdateRequest extends FormRequest
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
            'host' => ['required', 'string'],
            'port' => ['required', 'string'],
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'encryption' => ['required', 'in:ssl,tls'],
            'from_address' => ['required', 'string'],
            'from_name' => ['required', 'string'],
            'status' => ['required', 'in:0,1'],
        ];
    }
}
