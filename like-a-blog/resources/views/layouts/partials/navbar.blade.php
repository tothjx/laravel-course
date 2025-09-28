<nav class="navbar">
    <div class="navbar-container">
        <h1 class="navbar-brand">
            <a href="{{ route('home') }}">
                <i class="bi bi-box"></i>{{ config('blog.app_name') }}
            </a>
        </h1>
        <div class="navbar-nav">
            <a href="{{ route('home') }}">főoldal</a>
            <a href="{{ route('posts.index') }}">post-ok</a>
            <a href="{{ route('about') }}">névjegy</a>
        </div>
    </div>
</nav>
