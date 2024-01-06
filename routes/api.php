<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CommentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//crée un lien qui permettra aux clients: React, vue, angular, node, js, native
//récupérer la liste des pièces de théâtre
Route::get('theatre', [PostController::class,'index']);

//inscrire un utilisateur
Route::post('/login',[UserController::class,'login']);
Route::post('/register', [UserController::class, 'register']);

Route::delete('/delete/{id}', [UserController::class, 'destroy']);
Route::put('/update/{id}', [UserController::class, 'update']);
Route::post('/comments', [CommentController::class, 'store']);
Route::middleware('auth:sanctum')->group(function(){
    //ajouter une pièce de théâtre /POST /PUT /PATCH
    Route::post('theatre/create',[PostController::class,'store']);
    //modifier une pièce de théâtre /PUT /PATCH
    Route::put('theatre/edit/{theatre}', [PostController::class,'update']);
    //supprimer une pièce de théâtre /DELETE
    Route::delete('theatre/delete/{theatre}',[PostController::class,'destroy']); 
    //retourner l'utilisateur actuellement connecté
    Route::get('/user', function (Request $request) {
        return $request->user();
});
 
});