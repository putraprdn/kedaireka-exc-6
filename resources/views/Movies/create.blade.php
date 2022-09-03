@extends('layouts.main')

@section('content')
    <form action="{{ route('movie_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h3>Add New Movie</h3>
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" placeholder="..." name="title">
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Tahun</label>
            <input class="form-control" id="year" name="year" type="number" />
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">Negara</label>
            <input class="form-control" id="country" name="country" type="text" />
        </div>
        <div class="mb-3">
            <p>Pilih Genre</p>
            @foreach ($getGenres as $genre)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="genre{{ $genre->id }}"
                        value="{{ $genre->id }}" name="genres[]">
                    <label class="form-check-label" for="genre{{ $genre->id }}">{{ ucwords($genre->name, '-') }}</label>
                </div>
            @endforeach
            {{-- <label for="genre" class="form-label">Genre</label>
            <select class="form-select" name="genre" id="genre">
                <option selected disabled>Pilih Genre</option>
                @foreach ($getGenres as $genre)
                    <option value="{{ $genre->id }}">{{ ucfirst($genre->name) }}</option>
                @endforeach
            </select> --}}
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input class="form-control" type="file" id="image" name="image"
                accept="image/png, image/jpg, image/jpeg">
        </div>
        <button type="submit" class="btn btn-success px-4">Submit</button>
    </form>
@endsection
