@extends('layouts.guest')

@section('title', config('blog.app_name'))

@section('content')
<div class="page-header">
    <h1 class="page-title">Post-ok</h1>
</div>

<div class="posts-grid">
    @foreach(config('blog.posts') as $post)
        <article class="post-card-large">
            <h2 class="post-title-large">
                <a href="{{ route('posts.show', $post['id']) }}">
                    {{ $post['title'] }}
                </a>
            </h2>

            <div class="post-meta-large">
                <span><strong>Szerző:</strong> {{ $post['author'] }}</span>&nbsp;|&nbsp;
                <span><strong>Dátum:</strong> {{ $post['date'] }}</span>
            </div>

            <p class="post-content-large">
                {{ $post['content'] }}
            </p>

        </article>
    @endforeach
</div>

@if(count(config('blog.posts')) === 0)
    <div class="no-posts">
        <p>Jelenleg nincsenek elérhető post-ok.</p>
    </div>
@endif

@endsection