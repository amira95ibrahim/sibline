<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SystemSettingUpdateRequest extends FormRequest
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
            'short_name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'footer_text' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email'],
            'facebook' => ['required', 'string'],
            'twitter' => ['required', 'string'],
            'youtube' => ['required', 'string'],
            'logo_header' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'logo_footer' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'logo_login' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'favicon' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'status' => ['required', 'in:0,1'],
        ];
    }
}
