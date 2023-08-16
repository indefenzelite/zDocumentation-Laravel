<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VoteRequest extends FormRequest
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
                    'faq_id'     => 'required', 
                    'status'     => 'required', 
                    'user_id'     => 'nullable', 
                    'ip_address'     => 'nullable', 
                ];
                break;
            case 'update':
                $rules = [
                    'faq_id'     => 'required',  
                    'status'     => 'required',  
                    'user_id'     => 'nullable',  
                    'ip_address'     => 'nullable',                      
                ];
                break;
            default:
                $rules = [];
                break;
        }
        return $rules;
    }
   
}
