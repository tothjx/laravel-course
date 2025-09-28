@extends('layouts.guest')

@section('title', 'Főoldal - ' . config('blog.app_name'))

@section('content')
<div class="latest-posts">
    <h1 class="page-title">Legújabb post-ok</h1>

    <div class="posts-grid">
        @foreach(array_slice(config('blog.posts'), 0, 3) as $post)
            <article class="post-card">
                <h3 class="post-title-large">
                    <a href="{{ route('posts.show', $post['id']) }}">
                        {{ $post['title'] }}
                    </a>
                </h3>
                <div class="post-meta-large">
                    <span><strong>Szerző:</strong> {{ $post['author'] }}</span>&nbsp;|&nbsp;
                    <span><strong>Dátum:</strong> {{ $post['date'] }}</span>
                </div>
                <p class="post-content">
                    {{ $post['content'] }}
                </p>
            </article>
        @endforeach
    </div>
    <div class="hero-cta">
        <a href="{{ route('posts.index') }}" class="btn-primary">
            további post-ok megtekintése
        </a>
    </div>
</div>
@endsection