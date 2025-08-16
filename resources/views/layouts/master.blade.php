<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Shop')</title>

    {{-- Common CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    
    
</head>
<body>
    
    {{-- Top Bar --}}
    @include('layouts.topbar')

    {{-- Layout Wrapper --}}
    <div class="layout">
        {{-- Side Nav --}}
        @include('layouts.sidenav')

        {{-- Main Content Section --}}
        <div class="content">
            @yield('content')
        </div>
    </div>

    {{-- Common JS --}}
    <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
