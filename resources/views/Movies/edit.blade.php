@extends('layouts.main')

@section('content')
    <form action="{{ route('movie_update', $movie->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <h3>Edit Movie</h3>
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title"
                value="{{ $movie->title }}">
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Tahun</label>
            <input class="form-control" id="year" name="year" type="number" value="{{ $movie->year }}" />
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">Negara</label>
            <input class="form-control" id="country" name="country" type="text" value="{{ $movie->country }}" />
        </div>
        <div class="mb-3">
            <p>Pilih Genre</p>
            @php
                $genres = explode(',', $movie->genres_id);
                // print_r(in_array($genre->id, $genres) ? 'checked' : '');
            @endphp
            @foreach ($getGenres as $genre)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="genre{{ $genre->id }}"
                        value="{{ $genre->id }}" name="genres[]" {{ in_array($genre->id, $genres) ? 'checked' : '' }}>
                    <label class="form-check-label" for="genre{{ $genre->id }}">{{ ucfirst($genre->name) }}</label>
                </div>
            @endforeach
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input class="form-control" type="file" id="image" name="image"
                accept="image/png, image/jpg, image/jpeg">
        </div>
        <button type="submit" class="btn btn-success px-4">Submit</button>
    </form>
@endsection
