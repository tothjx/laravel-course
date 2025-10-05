<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    {{-- UIKit framework --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css" />

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>
<body>
    @include('partials.navigation')

    <main class="uk-container uk-margin-top">
        @yield('content')
    </main>

    <footer class="uk-section">
        <div class="uk-container">
            <div class="uk-text-center">
                <p>&copy; {{ date('Y') }} Blog Two. All rights reserved.</p>
            </div>
        </div>
    </footer>

    {{-- UIKit javascript libraries --}}
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>

    @stack('scripts')
</body>
</html>