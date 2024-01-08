<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                $comments = Comment::all();
                return response()->json($comments);
            }
            
            // Rest of the code...

    public function store(Request $request)
    {
        try{
            $comments= new Comment();
            $comments->note = $request->note;
            $comments->commentaire = $request->commentaire;
            $comments->theatre_titre = $request->theatre_titre;
            $comments->save();
    return response()->json([
        'status_code' => 200,
    'status_message'=>'Le commentaire a été ajouté',
    'data'=>$comments]);
        }
        catch(\Exception $e){return response()->json($e);}
       
    }
    
    
}