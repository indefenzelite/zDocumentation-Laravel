<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
                'name' => 'required|regex:/^[a-zA-Z]+.*$/',
                'slug'     => 'unique:items,slug|regex:/^[a-zA-Z]+.*$/',
                'sku'     => 'unique:items,sku|regex:/^[a-zA-Z]+.*$/',
                ];
                break;
            case 'update':
                $rules = [
                'name' => 'required|regex:/^[a-zA-Z]+.*$/',
                'slug'     => 'regex:/^[a-zA-Z]+.*$/|unique:items,slug,deleted_at,NULL,'.$this->id,
                'sku'     => 'regex:/^[a-zA-Z]+.*$/|unique:items,sku,deleted_at,NULL,'.$this->id,
                ];
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
                'name.required' => 'Name is required',
                'slug.required' => 'Slug is required',
                ];
                break;
            case 'update':
                $messages = [
                'name.required' => 'Name is required',
                'slug.required' => 'Slug is required',
                ];
                break;
            default:
                $messages = [];
                break;
        }
        return $messages;
    }
}
