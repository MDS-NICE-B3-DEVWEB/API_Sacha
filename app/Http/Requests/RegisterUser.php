<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
// Remove the line below
// use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class RegisterUser extends FormRequest
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
                    'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            
                  ];
                  if ($validator->fails())
                  {
                      return response(['errors'=>$validator->errors()->all()], 422);
                  }
                if ($validator->fails()) {
                    $request['password'] = Hash::make($request['password']);
                }
                  $request['remember_token'] = Str::random(10);
                  $user = User::create($request->toArray());
                  $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                  $response = ['token' => $token];
                  return response($response, 200);
    }
    
            
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
        'success'=>false,
        'status_code'=>422, 
        'errors'=>true,
        'message'=>'Erreur de validation',
        'errorsList'=>$validator->errors()]));
    }
    public function messages()
    {
        return[
            'name.required'=>'Le nom est obligatoire',
            'email.required'=>'Adresse mail obligatoire',
            'email.unique'=>'Adresse mail déjà utilisée',
            'password.required'=>'Mot de passe obligatoire',
            'password.min'=>'Mot de passe doit contenir au moins 6 caractères',
            'password.confirmed'=>'Mot de passe non confirmé',
        ];
    }
}
