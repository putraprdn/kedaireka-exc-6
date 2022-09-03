<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand me-5" href="/">
            <img src="{{ asset('assets/images/logo.png') }}">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-3 mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="movieDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Movies
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="movieDropdown">
                        <li><a class="dropdown-item" href="{{ route('movie_create') }}">Add Movie</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="genreDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Genres
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="genreDropdown">
                        <li><a class="dropdown-item" href="{{ route('genre_create') }}">Add Genre</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
