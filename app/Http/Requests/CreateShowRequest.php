<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;


class CreateShowRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',

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
            'title.required' => 'Le titre est obligatoire',
            'description.required' => 'La description est obligatoire',
            'price.required' => 'Le prix est obligatoire',
        ];
    } 
}
