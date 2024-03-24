<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest; // Import the missing class
use App\Http\Api\Auth\ApiAuthController;
use App\Models\Theatre;
use Exception;
use App\Models\Post;
use App\Models\Utilisateurs;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        
        try{
            $query=Theatre::query();
        $perPage = 2;
        $page=$request->input('page',1);
        $search=$request->input('search');
        if($search){
            $query->whereRaw('titre','like',"%$search%");
        }
        $total = $query->count();
        $result=$query->offset(($page-1)*$perPage)->limit($perPage)->get();
         
            return response()->json([
                'status_code' => 200,
            'status_message'=>'La liste des pièces de théâtre',
            'current_page'=>$page,
            'last_page'=>ceil($total/$perPage),
            'item'=>$result]);
        }
        catch(Exception $e){return response()->json($e);}
    }
    public function store(CreatePostRequest $request)
    {
        try{
            $user = Utilisateurs::find($request->user_id);
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }
            $theatre= new Theatre();
            $theatre->titre = $request->titre;
            $theatre->description = $request->description;
            $theatre->user_id = auth()->user()->id;
            $theatre->save();
    return response()->json([
        'status_code' => 200,
    'status_message'=>'La pièce a été ajouté',
    'data'=>$theatre]);
        }
        catch(Exception $e){return response()->json($e);}
       
    }
    public function update(EditPostRequest $request, Theatre $theatre){
        
try{
    $theatre->titre = $request->titre;
    $theatre->description = $request->description;
    if($theatre->user_id == auth()->user()->id){
        $theatre->save();}
    else{
        return response()->json([
            'status_code' => 403,
        'status_message'=>'Vous n\'êtes pas autorisé à modifier ce post',
        ]);
    }
    $theatre->save();
    return response()->json([
        'status_code' => 200,
    'status_message'=>'Le post a été modifié',
    'data'=>$theatre]);
}
catch(Exception $e){return response()->json($e);}
    }
    public function destroy(Theatre $theatre){
        try{
            if($theatre->user_id == auth()->user()->id){
                $theatre->delete();}
            else{
                return response()->json([
                    'status_code' => 403,
                'status_message'=>'Vous n\'êtes pas autorisé à supprimer cette pièce de théâtre',
                ]);
            }
            $theatre->delete();
            return response()->json([
                'status_code' => 200,
            'status_message'=>'La pièce a été supprimé',
            'data'=>$theatre]);
        }
        catch(Exception $e){
            // handle exception
        }
    }
    
}
  