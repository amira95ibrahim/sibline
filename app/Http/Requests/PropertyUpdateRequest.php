<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyUpdateRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'start_date' => ['required','date'],
            'end_date' => ['required','date'],
            'image' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'video' => ['mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv'],
            'status' => ['required', 'in:0,1'],

            'developer_id' => 'required_without:customer_id',
            'customer_id' => 'required_without:developer_id',
            'partner_id' => 'required',
            'broker_id' => 'required_with:partner_id',


            'brief' => ['nullable','string'],
            'description' => ['nullable','string'],
            'min_investment' => ['nullable', 'integer'],
            'max_investment' => ['nullable', 'integer'],
            'rental_breakdown' => ['nullable', 'string'],
            'size' => ['nullable', 'integer'],
            'price' => ['nullable', 'integer'],
            'property_type_id' => ['nullable'],

            
            // address validation
            'country_id' => ['nullable','exists:countries,id'],
            'city_id' => ['nullable','exists:countries,id'],
            'area' => ['nullable','string'],
            'address' => ['nullable','string'],
            'street' => ['nullable','string'],
            'gps' => ['nullable','string'],
            'zip_code' => ['nullable','string'],

            // photo validation
            'photo.*.title' => ['nullable', 'string'],
            'photo.*.url' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            // video validation
            'videos.*.title' => ['nullable', 'string'],
            'videos.*.url' => ['mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv'],
            // document validation
            'document.*.title' => ['nullable', 'string'],


            
        ];
    }
}
