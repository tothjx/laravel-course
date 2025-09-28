<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('blog.app_name'))</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .container {
            max-width: {{ config('blog.layout_width') }};
        }
    </style>
</head>
<body>
    @include('layouts.partials.navbar')

    <main class="content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    @include('layouts.partials.footer')

    @yield('scripts')
</body>
</html>