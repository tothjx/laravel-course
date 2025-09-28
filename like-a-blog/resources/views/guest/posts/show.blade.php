@extends('layouts.guest')

@section('title', $post['title'] . ' - ' . config('blog.app_name'))

@section('content')

<article class="post-article">
    <header class="post-header">
        <h1 class="post-article-title">
            {{ $post['title'] }}
        </h1>

        <div class="post-article-meta">
            <span><strong>Szerző:</strong> {{ $post['author'] }}</span>
            <span><strong>Publikálva:</strong> {{ $post['date'] }}</span>
        </div>
    </header>

    <div class="post-article-content">
        {!! nl2br(e($post['content'])) !!}
    </div>

</article>

@endsection