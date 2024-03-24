<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
        $data = [
            'uom' => 'required|max:10',
            'description' => 'required|max:255'
        ];

        if (request()->isMethod('PUT')) {
            $data['name'] = 'required|max:100|unique:products,name,'.$this->product->id;
            $data['image'] = 'max:255';
        }else{
            $data['name'] = 'required|max:100|unique:products,name';
            $data['image'] = 'max:255';
        }

        return $data;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response($validator->errors(),422));
    }

}
