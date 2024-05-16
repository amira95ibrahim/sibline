<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseUpdateRequest extends FormRequest
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
            'amount' => ['required', 'integer'],
            'title' => ['required', 'string'],
            'date' => ['required', 'date' , 'before_or_equal:today'],
            'partner_id' => ['required'],
            'property_id' => ['required'],
            'photo.*.title' => ['nullable', 'string'],
            'photo.*.url' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ];
    }
}
