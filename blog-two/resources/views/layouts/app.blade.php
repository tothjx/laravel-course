{{-- Main Application Layout --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    {{-- UIKit CSS Framework --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css" />

    {{-- Custom Styles Stack --}}
    @stack('styles')
</head>
<body>
    {{-- Include Navigation Partial --}}
    @include('partials.navigation')

    {{-- Main Content Area --}}
    <main class="uk-container uk-margin-top">
        @yield('content')
    </main>

    {{-- Footer Section --}}
    <footer class="uk-section uk-section-secondary uk-margin-large-top">
        <div class="uk-container">
            <div class="uk-text-center">
                <p>&copy; {{ date('Y') }} Blog Two. All rights reserved.</p>
            </div>
        </div>
    </footer>

    {{-- UIKit JavaScript Libraries --}}
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>

    {{-- Custom Scripts Stack --}}
    @stack('scripts')
</body>
</html>