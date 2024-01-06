<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateCommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'commentaire' => 'required',
            'theatre_titre.required' => 'required',
            
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
            'commentaire.required' => 'Commentaire obligatoire',
            'theatre_titre.required' => 'Titre obligatoire',
        ];
    } 
}
