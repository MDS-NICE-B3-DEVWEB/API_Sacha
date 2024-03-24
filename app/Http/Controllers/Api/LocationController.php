<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTheatreRequest;
use App\Http\Requests\EditPostRequest;
use App\Models\Location; // Utilisez Location ici
use Exception;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Location::query(); // Utilisez Location ici
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
            'status_message'=>'La liste des théâtre',
            'current_page'=>$page,
            'last_page'=>ceil($total/$perPage),
            'item'=>$result]);
        }
        catch(Exception $e){return response()->json($e);}
    }
    public function store(CreateTheatreRequest $request)
    {
        try{
            $location= new Location();
            $location->nom = $request->nom;
            $location->adresse = $request->adresse;
            $location->ville = $request->ville;
            $location->SIRET = $request->SIRET;
            $location->user_id = auth()->user()->id;
            $location->save();
    return response()->json([
        'status_code' => 200,
    'status_message'=>'La théâtre a été ajouté',
    'data'=>$location]);
        }
        catch(Exception $e){return response()->json($e);}
       
    }
    public function update(EditPostRequest $request, Location $location){
        
try{
    $location->nom = $request->nom;
            $location->adresse = $request->adresse;
            $location->ville = $request->ville;
            $location->SIRET = $request->SIRET;
    if($location->user_id == auth()->user()->id){
        $location->save();}
    else{
        return response()->json([
            'status_code' => 403,
        'status_message'=>'Vous n\'êtes pas autorisé à modifier ce théâtre',
        ]);
    }
    $location->save();
    return response()->json([
        'status_code' => 200,
    'status_message'=>'Le théâtre a été modifié',
    'data'=>$location]);
}
catch(Exception $e){return response()->json($e);}
    }
    public function destroy(Location $theatre){
        try{
            if($theatre->user_id == auth()->user()->id){
                $theatre->delete();}
            else{
                return response()->json([
                    'status_code' => 403,
                'status_message'=>'Vous n\'êtes pas autorisé à supprimer ce théâtre',
                ]);
            }
            $theatre->delete();
            return response()->json([
                'status_code' => 200,
            'status_message'=>'Le théâtre a été supprimé',
            'data'=>$theatre]);
        }
        catch(Exception $e){
            // handle exception
        }
    }
    
}
  