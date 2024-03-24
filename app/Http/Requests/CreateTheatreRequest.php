<?php

namespace App\Http\Requests;

use App\Models\Utilisateurs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// Remove the line below
// use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CreateTheatreRequest extends FormRequest
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
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'SIRET' => 'required|string',
            
                  ];
    }
    
            
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
        'success'=>false,
        'errors'=>true,
        'message'=>'Erreur de validation',
        'errorsList'=>$validator->errors()]));
    }
    public function messages()
    {
        return[
            'nom.required'=>'Le nom est obligatoire',
            'ville.required'=>'La ville est obligatoire',
            'adresse.required'=>'L\'adresse est obligatoire',
            'SIRET.required'=>'Le SIRET est obligatoire',
            'email.required'=>'Adresse mail obligatoire',
            'email.unique'=>'Adresse mail déjà utilisée',
        ];
    }
}
