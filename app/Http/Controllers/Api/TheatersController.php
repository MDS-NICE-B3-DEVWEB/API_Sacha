<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTheatersRequest;
use App\Http\Requests\EditPostRequest; // Import the missing class
use App\Http\Api\Auth\ApiAuthController;
use App\Models\Theaters;
use Exception;
use App\Models\Post;
use Illuminate\Http\Request;

class TheatersController extends Controller
{
    public function index(Request $request)
    {

        try {
            $query = Theaters::query();
            $perPage = 2;
            $page = $request->input('page', 1);
            $search = $request->input('search');
            if ($search) {
                $query->whereRaw('titre', 'like', "%$search%");
            }
            $total = $query->count();
            $result = $query->offset(($page - 1) * $perPage)->limit($perPage)->get();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'La liste des pièces de théâtre',
                'current_page' => $page,
                'last_page' => ceil($total / $perPage),
                'item' => $result
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    public function store(CreateTheatersRequest $request)
    {
        try {
            $theaters = new Theaters();
            $theaters->name = $request->name;
            $theaters->adress = $request->adress;
            $theaters->SIRET = $request->SIRET;
            $theaters->user_id = auth()->user()->id;
            $theaters->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le post a été modifié',
                'data' => $theaters
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    public function update(CreateTheatersRequest $request, Theaters $theaters)
    {

        try {
            $theaters->name = $request->name;
            $theaters->adress = $request->adress;
            $theaters->SIRET = $request->SIRET;
            if ($theaters->user_id == auth()->user()->id) {
                $theaters->save();
            } else {
                return response()->json([
                    'status_code' => 403,
                    'status_message' => 'Vous n\'êtes pas autorisé à modifier ce théâtre',
                ]);
            }
            $theaters->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le post a été modifié',
                'data' => $theaters
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    public function destroy(Theaters $theaters)
    {
        try {
            if ($theaters->user_id == auth()->user()->id) {
                $theaters->delete();
            } else {
                return response()->json([
                    'status_code' => 403,
                    'status_message' => 'Vous n\'êtes pas autorisé à supprimer cette pièce de théâtre',
                ]);
            }
            $theaters->delete();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'La pièce a été supprimé',
                'data' => $theaters
            ]);
        } catch (Exception $e) {
            // handle exception
        }
    }
}
