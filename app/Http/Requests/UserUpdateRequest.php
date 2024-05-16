<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email' => ['required', 'email', 'unique:users,email,'.$this->user->id.',id,deleted_at,NULL'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'role_id' => ['required'],
            'status' => ['required'],
            'image' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ];
    }
}
