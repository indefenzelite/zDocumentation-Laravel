<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddressRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch ($this->request_with) {
            case 'create':
                $rules = [
                    'user_id'     => 'required',
                    'type'     => 'required|regex:/^[a-zA-Z]+.*$/',
                    'name'     => 'required|regex:/^[a-zA-Z]+.*$/',
                    'phone'     => 'required|numeric_phone_length:10,15',
                    'address_1'     => 'required|regex:/^[a-zA-Z]+.*$/',
                ];
                break;
            default:
                $rules = [];
                break;
        }
        return $rules;
    }
    public function messages()
    {
        switch ($this->request_with) {
            case 'create':
                $messages = [
                'user_id.required' => 'User is required',
                'type.required' => 'Type is required',
                ];
                break;
            default:
                $messages = [];
                break;
        }
        return $messages;
    }
}
