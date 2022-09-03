<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    function create()
    {
        return view('genres.create');
    }

    function store(Request $request)
    {
        $name = trim(strtolower($request->name));
        $description = trim(strtolower($request->description));

        Genre::create([
            "name" => $name,
            "description" => $description
        ]);

        return redirect('/');
    }
}
