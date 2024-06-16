<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('files.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        return back()->with('success', 'Files successfully uploaded');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
