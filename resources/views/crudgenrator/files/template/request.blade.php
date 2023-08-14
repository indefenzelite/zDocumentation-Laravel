<{{ $data['wildcard'] }}php

namespace App\Http\Requests\{{ ucfirst($data['view_path']) }};

use Illuminate\Foundation\Http\FormRequest;

class {{ $data['model'] }}Request extends FormRequest
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
                $rules = [@foreach($data['validations']['field'] as $index => $item)

                    '{{ $item }}'     => '{{ $data['validations']['rules'][$index] }}', @endforeach

                ];
                break;
            case 'update':
                $rules = [@foreach($data['validations']['field'] as $index => $item)

                    '{{ $item }}'     => '{{ $data['validations']['rules'][$index] }}',  @endforeach
                    
                ];
                break;
            default:
                $rules = [];
                break;
        }
        return $rules;
    }
   
}
