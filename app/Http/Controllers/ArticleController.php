<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = ['message' => 'article index'];
        return response($response, 200);
    
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = ['message' =>  'store function'];
return response($response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = ['message' =>  'show function'];
return response($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $response = ['message' =>  'update function'];
return response($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = ['message' =>  'destroy function'];
        return response($response, 200);
    }
}
