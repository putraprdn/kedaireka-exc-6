<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    function index()
    {
        $movieGenreOnly = Movie::selectRaw('movies.*, group_concat(genres.name order by genres.name) as genres')
            ->join('genre_movie', "movies.id", "=", "genre_movie.movie_id")
            ->join('genres', 'genre_movie.genre_id', '=', 'genres.id')
            ->groupBy('movies.id')
            ->orderBy('genre_movie.genre_id')
            ->get();

        $genres = Genre::selectRaw('genres.id, genres.name, genres.description, gm.genre_id as genre_id')
            ->join('genre_movie as gm', 'genres.id', '=', 'gm.genre_id')
            ->groupBy('genres.id')
            ->orderBy('genres.name')
            ->get();

        $movieInfo = Movie::Select('movies.*', 'genre_movie.*')
            ->join('genre_movie', 'movies.id', '=', 'genre_movie.movie_id')
            // ->orderBy('genre_movie.genre_id')
            ->orderBy("updated_at", 'desc')
            ->get();
        // ->toSql();

        // dd($movieInfo);

        return view('movies.index', compact('genres', 'movieInfo', 'movieGenreOnly'));
    }

    function create()
    {
        $getGenres = Genre::orderBy('genres.name')->get();
        return view('movies.create', compact('getGenres'));
    }

    function store(Request $request)
    {
        // dd($newArr);

        // if image is not null
        $imageName = null;
        if ($request->file('image')) {
            $onlyName = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = time() . '_' . $onlyName . '.' . $request->image->extension();
            // ## Store in public/images/this.png
            $request->image->move(public_path('assets/images/upload'), $imageName);
        }


        // ## Store in store/app/images/this.png
        // $request->image->storeAs('images', $imageName);

        $movie = Movie::create([
            "title" => $request->title,
            "country" => $request->country,
            "year" => $request->year,
            "image" => $imageName ?? null
        ]);


        // foreach ($request->genres as $index => $value) {
        //     $genre = Genre::find([$value]);
        //     $movie->genres()->attach($genre);
        // }

        $genre = Genre::find([...$request->genres]);
        $movie->genres()->attach($genre);

        // dd($genre);
        // $genre = Genre::find([$request->genre, ..., ...]);

        return redirect('/');
    }

    function edit($id)
    {
        $getGenres = Genre::orderBy('genres.name')->get();
        $movie = Movie::selectRaw('movies.*, group_concat(genres.id) as genres_id')
            ->join('genre_movie', "movies.id", "=", "genre_movie.movie_id")
            ->join('genres', 'genre_movie.genre_id', '=', 'genres.id')
            ->groupBy('movies.id')
            ->where('movies.id', $id)
            ->first();

        // dd($movie);
        return view('movies.edit', compact('getGenres', 'movie'));
    }

    function update(Request $request, $id)
    {
        // Store image
        $imageName = null;
        if ($request->file('image')) {
            $onlyName = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = time() . '_' . $onlyName . '.' . $request->image->extension();
            // ## Store in public/images/this.png
            $request->image->move(public_path('assets/images/upload'), $imageName);
        }

        // Store data
        $movie = Movie::findOrFail($id);
        $movie->update([
            "title" => $request->title ?? $movie->title,
            "country" => $request->country ?? $movie->country,
            "year" => $request->year ?? $movie->year,
            "image" => $imageName ?? $movie->image,
        ]);


        $getGenres = DB::table('genre_movie')
            ->selectRaw('movie_id, group_concat(genre_id) as genres')
            ->where('movie_id', $id)
            ->first();
        // convert & store to array
        $getGenresArr = explode(',', $getGenres->genres);

        // check if request's genres is not null to avoid error
        $reqGenresArr = [];
        if ($request->genres) {
            $reqGenresArr = [...$request->genres];
        }

        // store deleted genres in new array
        $removeGenresArr = [];
        foreach ($getGenresArr as $key => $getGenre) {
            if (!in_array($getGenre, $reqGenresArr)) {
                array_push($removeGenresArr, $getGenre);
            }
        }

        // remove from pivot table
        $removeGenre = Genre::find([...$removeGenresArr]);
        $movie->genres()->detach($removeGenre);

        // store newly added genres in new array
        $addGenresArr = [];
        foreach ($reqGenresArr as $key => $reqGenre) {
            if (!in_array($reqGenre, $getGenresArr)) {
                array_push($addGenresArr, $reqGenre);
            }
        }

        // store in pivot table
        $addGenre = Genre::find([...$addGenresArr]);
        $movie->genres()->attach($addGenre);

        return redirect('/');
    }

    function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect('/');
    }
}
