<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RememeberSystemReqest extends FormRequest
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
            'status_account' => 'required|in:1,2,3,4',
            'time' => 'required|numeric'
        ];
    }
}
