<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
                'title' => 'required|regex:/^[a-zA-Z]+.*$/',
                // 'description_banner'=>'required',
                // 'description'=>'required',
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
                'title.required' => 'Title Name is required',
                // 'description_banner.required' => 'Description Banner is required',
                // 'description.required' => 'Description is required',
                ];
                break;
            default:
                $messages = [];
                break;
        }
        return $messages;
    }
}
