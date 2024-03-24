<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SupplierRequest extends FormRequest
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
            'address' => 'required|max:255',
            'email' => 'required|max:100',
            'phone' => 'required|max:20'
        ];

        if (request()->isMethod('PUT')) {
            $data['name'] = 'required|unique:suppliers,name,'.$this->supplier->id;
        }else{
            $data['name'] = 'required|unique:suppliers,name';
        }

        return $data;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response($validator->errors(),422));
    }
}
