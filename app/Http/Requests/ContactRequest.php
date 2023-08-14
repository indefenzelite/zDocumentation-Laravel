<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
                'first_name' => 'required|max:255|regex:/^[a-zA-Z]+.*$/',
                'last_name' => 'required|max:255|regex:/^[a-zA-Z]+.*$/',
                'phone' => 'required|numeric_phone_length:10,15',
                'email' => 'required|email|regex:/^[a-zA-Z]+.*$/',
                ];
                break;
            case 'update':
                $rules = [
                'first_name' => 'required|max:255|regex:/^[a-zA-Z]+.*$/',
                'last_name' => 'required|max:255|regex:/^[a-zA-Z]+.*$/',
                'phone' => 'required|numeric_phone_length:10,15',
                'email' => 'required|email|regex:/^[a-zA-Z]+.*$/',
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
                'first_name.required' => 'First Name is required',
                'last_name.required' => 'Last Name is required',
                'email.required' => 'Email is required',
                ];
                break;
            default:
                $messages = [];
                break;
        }
        return $messages;
    }
}
