<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageStoreRequest extends FormRequest
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
            'url' => ['required', 'string'],
            'name' => ['required','string'],
            'title' => ['required','string'],
            'content' => ['nullable', 'string'],
            'brief' => ['nullable', 'string'],
            'open_in_new_tab' => ['required', 'in:0,1'],
            'display_top_menu' => ['required', 'in:0,1'],
            'display_sidebar' => ['required', 'in:0,1'],
            'president' => ['required', 'integer'],
            'parent_id' => ['nullable', 'exists:pages,id'],
            
            'icon' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'image' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'status' => ['required', 'in:0,1'],
        ];
    }
}
