<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateThemeRequest;
use App\Http\Requests\EditPostRequest; // Import the missing class
use App\Http\Api\Auth\ApiAuthController;
use App\Models\Theme;
use Exception;
use App\Models\Post;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index(CreateThemeRequest $request)
    {

        try {
            $query = Theme::query();
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
    public function store(CreateThemeRequest $request)
    {
        try {
            $theme = new Theme();
            $theme->name = $request->name;
            $theme->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le post a été modifié',
                'data' => $theme
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    public function update(CreateThemeRequest $request, Theme $theme)
    {

        try {
            $theme->name = $request->name;
            $theme->adress = $request->adress;
            $theme->SIRET = $request->SIRET;
            if ($theme->user_id == auth()->user()->id) {
                $theme->save();
            } else {
                return response()->json([
                    'status_code' => 403,
                    'status_message' => 'Vous n\'êtes pas autorisé à modifier ce théâtre',
                ]);
            }
            $theme->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le post a été modifié',
                'data' => $theme
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    public function destroy(Theme $theme)
    {
        try {
            if ($theme->user_id == auth()->user()->id) {
                $theme->delete();
            } else {
                return response()->json([
                    'status_code' => 403,
                    'status_message' => 'Vous n\'êtes pas autorisé à supprimer cette pièce de théâtre',
                ]);
            }
            $theme->delete();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'La pièce a été supprimé',
                'data' => $theme
            ]);
        } catch (Exception $e) {
            // handle exception
        }
    }
}
