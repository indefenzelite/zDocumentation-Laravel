<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                'first_name'     => 'required | string|max:30|regex:/^[a-zA-Z]+.*$/ ',
                'phone'     => 'sometimes|nullable|numeric_phone_length:10,15',
                'last_name'     => 'required | string |max:30|regex:/^[a-zA-Z]+.*$/',
                'email'    => 'required | email | regex:/^[a-zA-Z]+.*$/',
                'password' => 'required',
                'gender' => 'nullable|in:Male,Female',
                'role'     => 'required',
                ];
                break;
            case 'update':
                $rules = [
                'first_name'     => 'required | string|max:30 |regex:/^[a-zA-Z]+.*$/',
                'phone'     => 'sometimes|nullable|numeric_phone_length:10,15',
                'last_name'     => 'required | string |max:30|regex:/^[a-zA-Z]+.*$/',
                'password'     => 'confirmed',
                'gender' => 'nullable|in:Male,Female',
                'email'    => 'required|email',
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
                'first_name.required'     => 'First Name is required',
                'last_name.required'     => 'Last Name is required',
                'email.required'    => 'Email is required',
                'email.unique'    => 'Email must be Unique',
                'password.required' => 'Password is required',
                'role.required'     => 'Role is required',
                // 'phone.required'   => 'Phone must be at least 10 characters.',
                ];
                break;
            case 'update':
                $messages = [
                'first_name.required'     => 'First Name is required',
                'last_name.required'     => 'Last Name is required',
                'email.required'    => 'Email is required',
                'email.unique'    => 'Email must be Unique',
                ];
                break;
            default:
                $messages = [];
                break;
        }
        return $messages;
    }
}
