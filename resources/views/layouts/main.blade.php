<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <x-style></x-style>
    @stack('style')

    <title>Movies ID</title>
</head>

<body>

    {{-- Navbar --}}
    <x-navbar></x-navbar>

    {{-- Main Content --}}
    <div class="container">
        @yield('content')
    </div>

    {{-- script --}}
    <x-script></x-script>
    @stack('script')

</body>

</html>
