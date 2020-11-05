<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrantStoreRequest extends FormRequest
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
            'name'        => 'required|string|unique:grants',
            'grantor'     => 'required|string',
            'status'      => 'required|string',
            'location'    => 'required|string',
            'description' => 'required|string',
            'amount'      => 'required|integer',
        ];
    }

     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'        => 'Grant name is required!',
            'grantor.required'     => 'Grantor is required!',
            'status.required'      => 'Grant status is required!',
            'location.required'    => 'Location is required!',
            'description.required' => 'Grant description is required',
            'amout.required'       => 'Grant amount is required'
        ];
    }
}
