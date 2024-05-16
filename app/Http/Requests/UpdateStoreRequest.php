<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreRequest extends FormRequest
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
            'description' => ['nullable', 'string'],
            'title' => ['required', 'string'],
            'date' => ['required', 'date' , 'before_or_equal:today'],
            'partner_id' => ['required'],
            'property_id' => ['required'],
            'photo.*.title' => ['required', 'string'],
            'photo.*.url' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ];
    }
}
