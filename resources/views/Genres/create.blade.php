@extends('layouts.main')

@section('content')
    <form action="{{ route('genre_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h3>Add Genre</h3>
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input class="form-control" id="name" placeholder="..." name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <button type="submit" class="btn btn-success px-4">Submit</button>
    </form>
@endsection
