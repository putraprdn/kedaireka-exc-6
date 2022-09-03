@extends('layouts.main')

@section('content')
    @foreach ($genres as $genre)
        <div class="category-container">
            <div class="d-flex justify-content-between mb-2">
                <h3 id="{{ strToLower($genre->name) }}">{{ ucfirst($genre->name) }}</h3>
                <p>View all</p>
            </div>
            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    {{-- Swiper Start --}}
                    @foreach ($movieInfo as $movie)
                        @if ($movie->genre_id === $genre->id)
                            <div class="swiper-slide">
                                <div class="card p-2">
                                    @php
                                        $image = $movie->image ?? 'yntkts.jpg';
                                        $isImageExists = file_exists(public_path('assets/images/upload/' . $image));
                                        if (!$isImageExists) {
                                            $image = 'yntkts.jpg';
                                        }
                                    @endphp
                                    <img src="{{ asset('assets/images/upload/' . $image) }}" class="card-img-top rounded-2">
                                    <div class="card-body p-3">
                                        <p class="year card-text mb-2 fs-6">{{ Str::upper($movie->country) }},
                                            {{ $movie->year }}
                                        </p>
                                        <h5 class="title card-title fs-4">{{ ucwords(strtolower($movie->title), ' ') }}</h5>
                                        @foreach ($movieGenreOnly as $movieGenre)
                                            @if ($movie->movie_id === $movieGenre->id)
                                                @php
                                                    $genreArr = explode(',', $movieGenre->genres);
                                                    // $genreArr = ucwords(strtolower($newGenre), ', -');
                                                    // $newGenre = str_replace(',', ', ', $movieGenre->genres);
                                                @endphp
                                                <div class="link-wrapper d-flex flex-wrap mb-2">
                                                    @foreach ($genreArr as $link)
                                                        <a class="genre fs-6"
                                                            href="#{{ $link }}">{{ ucwords(strtolower($link), ', -') }}</a>
                                                    @endforeach
                                                </div>
                                                {{-- {{ $newGenre }} --}}
                                            @endif
                                        @endforeach
                                        <div class="card__button-container row flex-column justify-content-between m-0">
                                            <div class="p-0 mb-2">
                                                <a class="btn btn-primary" href="{{ route('movie_edit', $movie->movie_id) }}">
                                                    Edit
                                                </a>
                                            </div>
                                            <div class="p-0">
                                                <form action="{{ route('movie_destroy', $movie->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                {{-- <div class="swiper-pagination"></div> --}}
            </div>
        </div>

        <!-- Initialize Swiper -->
    @endforeach
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 20,
            // pagination: {
            //     el: ".swiper-pagination",
            //     clickable: true,
            // },
        });
    </script>
@endpush
