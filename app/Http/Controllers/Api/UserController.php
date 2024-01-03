<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\LogUserRequest;
class UserController extends Controller
{
    public function register(RegisterUser $request)
    {
        try{
            $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->type = 1; // Remplacez 'default_value' par la valeur que vous voulez
        $user->save();
            return response()->json([
                'status_code' => 200,
            'status_message'=>'Utilisateur enregistré',
            'user'=>$user
            ]);
        }
        catch(\Exception $e){
            return response()->json($e);
        }
        
    }
    public function login(LogUserRequest $request){
if(auth()->attempt($request->only('email','password'))){
    $user=auth()->user();
    $token=$user->createToken('authToken')->plainTextToken;
    return response()->json([
        'status_code' => 200,
        'status_message'=>'Utilisateur connecté',
        'user'=>$user,
        'token'=>$token
    ]);}
    else{
        //si les les informations de connexion sont incorrectes
        return response()->json([
        'status_code' => 403 ,
        'status_message'=>'Informations de connexion incorrectes',
        ]);
    } 
    }
}
