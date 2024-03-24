<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class CustomerRequest extends FormRequest
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
            'email' => 'required|email|max:100',
            'phone' => 'required|numeric',
        ];

        if (request()->isMethod('PUT')) {
            $data['name'] = 'required|unique:customers,name,'.$this->customer->id;
        }else{
            $data['name'] = 'required|unique:customers,name';
        }

        return $data;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response($validator->errors(),422));
    }
}
