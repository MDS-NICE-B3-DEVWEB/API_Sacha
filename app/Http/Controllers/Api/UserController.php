<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\LogUserRequest;
use App\Http\Requests\CreatePostRequest;
use Exception;
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
    public function logout(Request $request){
        try{
            if ($request->user()) {
                // Révoquez le token
                $request->user()->currentAccessToken()->delete();
            }
            return response()->json([
                'status_code' => 200,
            'status_message'=>'Utilisateur déconnecté',
            ]);
        }
        catch(Exception $e){
            return response()->json($e);
        }
        
    }

    public function destroy(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            if($user->id != auth()->user()->id){
                return response()->json([
                    'status_code' => 403,
                    'status_message'=>'Vous n\'êtes pas autorisé à modifier cet utilisateur',
                ]);}
            $user->delete();
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'L\'utilisateur a été supprimé',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Une erreur est survenue lors de la suppression de l\'utilisateur : ' . $e->getMessage(),
            ]);
        }
    }


public function update(Request $request, User $user)
{
    try {
        if($user->id != auth()->user()->id){
            return response()->json([
                'status_code' => 403,
                'status_message'=>'Vous n\'êtes pas autorisé à modifier cet utilisateur',
            ]);
        }

        $user->name = $request->get('name', $user->name);
        $user->email = $request->get('email', $user->email);
        // Add more fields here as needed

        $user->save();

        return response()->json([
            'status_code' => 200,
            'status_message'=>'L\'utilisateur a été modifié',
            'data'=>$user
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status_code' => 500,
            'status_message' => 'Une erreur est survenue lors de la modification de l\'utilisateur : ' . $e->getMessage(),
        ]);
    }
}
}
        // handle exception




