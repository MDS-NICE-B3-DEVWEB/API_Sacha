<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateShowRequest;
use App\Http\Requests\EditPostRequest; // Import the missing class
use App\Http\Api\Auth\ApiAuthController;
use App\Models\Show;
use Exception;
use App\Models\Post;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function index(Request $request)
    {

        try {
            $query = Show::query();
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
public function show($id)
{
    $show = Show::find($id);

    if ($show) {
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Pièce de théâtre trouvée',
            'show' => $show
        ]);
    } else {
        return response()->json([
            'status_code' => 404,
            'status_message' => 'Pièce de théâtre non trouvée'
        ], 404);
    }
}
    public function store(CreateShowRequest $request)
    {
        try {
            $show = new Show();
            $show->title = $request->title;
            $show->description = $request->description;
            $show->price = $request->price;
            $show->theater_id = $request->theater_id;
            $show->theme_id = $request->theme_id;
            $show->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le spectacle a été modifié',
                'data' => $show
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    public function update(CreateShowRequest $request, Show $show)
    {

        try {
            $show->title = $request->title;
            $show->description = $request->description;
            $show->price = $request->price;
            if ($show->user_id == auth()->user()->id) {
                $show->save();
            } else {
                return response()->json([
                    'status_code' => 403,
                    'status_message' => 'Vous n\'êtes pas autorisé à modifier ce théâtre',
                ]);
            }
            $show->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le post a été modifié',
                'data' => $show
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    public function destroy(Show $show)
    {
        try {
            if ($show->user_id == auth()->user()->id) {
                $show->delete();
            } else {
                return response()->json([
                    'status_code' => 403,
                    'status_message' => 'Vous n\'êtes pas autorisé à supprimer cette pièce de théâtre',
                ]);
            }
            $show->delete();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'La pièce a été supprimé',
                'data' => $show
            ]);
        } catch (Exception $e) {
            // handle exception
        }
    }
}
