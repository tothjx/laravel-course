{{-- Navigation Bar --}}
<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">
        {{-- Brand Logo --}}
        <a class="uk-navbar-item uk-logo" href="{{ route('home') }}" style="margin-left: 20px;">blog two</a>

        {{-- Navigation Links --}}
        <ul class="uk-navbar-nav">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('blog') }}">Blog</a></li>
            <li><a href="{{ route('about') }}">About</a></li>
        </ul>
    </div>
</nav>