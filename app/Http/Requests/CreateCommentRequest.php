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
            'note' => 'required|integer|min:0|max:5',
            'commentaire' => 'required',
            'theatre_nom.required' => 'required',
            
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
            'note.required' => 'Note obligatoire',
            'commentaire.required' => 'Commentaire obligatoire',
            'theatre_nom.required' => 'Titre obligatoire',
        ];
    } 
}