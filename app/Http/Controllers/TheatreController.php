<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theatre;

class TheatreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
{
    $theatre = new Theatre;
    $theatre->name = $request->name;
    $theatre->description = $request->description;
    // ... set any other fields ...
    $theatre->save();

    return response()->json($theatre, 201);
}
    
    /**
     * Display the specified resource.
     */

        public function store(Request $request)
{
    $theatre = new Theatre;
    $theatre->name = $request->name;
    $theatre->description = $request->description;
    // ... set any other fields ...
    $theatre->save();

    return response()->json($theatre, 201);
}
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
