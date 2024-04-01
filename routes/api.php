<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Api\LocationController;
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


//2|xyv1FZzEuEhx7Iltnr3XHKum5hkgcyMisTcAIsjx0103cbbc
//inscrire un utilisateur

Route::post('/login',[UserController::class,'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);

Route::post('theatre/create',[PostController::class,'store']);
Route::get('theatre', [PostController::class,'index']);
Route::middleware('auth:sanctum')->group(function(){
    //récupérer la liste des pièces de théâtre
    Route::delete('/delete/{id}', [UserController::class, 'destroy']);
    Route::put('/update/{id}', [UserController::class, 'update']);
    Route::get('/user', [UserController::class, 'user']);
    //ajouter une pièce de théâtre /POST /PUT /PATCH
    Route::post('location/create', [LocationController::class, 'store']);
    
    //modifier une pièce de théâtre /PUT /PATCH
    Route::put('theatre/edit/{theatre}', [PostController::class,'update']);
    //supprimer une pièce de théâtre /DELETE
    Route::delete('theatre/delete/{theatre}',[PostController::class,'destroy']);
    //ajouter un commentaire 
    Route::post('/comments', [CommentController::class, 'store']);
    Route::get('/comments', [CommentController::class, 'index']);
    
    //retourner l'utilisateur actuellement connecté
    Route::get('/user', function (Request $request) {
        return $request->user();
});
 
});