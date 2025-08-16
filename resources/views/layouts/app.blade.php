<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>

    {{-- Bootstrap CSS CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Extra styles (if needed by individual pages) --}}
    @stack('styles')
</head>
<body>
    {{-- Navbar --}}
    @include('partials.navbar') {{-- Optional: if you have a navbar file --}}

    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- Bootstrap Bundle with Popper --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- jQuery CDN --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- Custom JS --}}
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- Extra scripts (if needed by individual pages) --}}
    @stack('scripts')
</body>
</ht
