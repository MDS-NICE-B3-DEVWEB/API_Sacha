<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;


class CreateTheatersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'adress' => 'required',
            'SIRET' => ['required', 'digits:14'],

        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
        'success'=>false,
        'error'=>true,
        'message'=>'Erreur de validation',
        'errorList'=> $validator->errors()
        ]));
    }
    public function messages(){
        return [
            'name.required' => 'Le nom du théâtre est obligatoire',
            'adress.required' => 'Une adresse est obligatoire',
            'SIRET.required' => 'Le SIRET est obligatoire',
        ];
    } 
}
