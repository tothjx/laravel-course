@extends('layouts.app')

@section('title', $article->title . ' - AnotherNews')

@section('content')
<div class="mb-4">
    <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary">&larr; Vissza a cikkekhez</a>
</div>

<article>
    <header class="mb-4">
        <h1 class="display-4">{{ $article->title }}</h1>

        <div class="text-muted mb-3">
            <span>Szerző: <a href="{{ route('users.show', $article->user) }}">{{ $article->user->name }}</a></span>
            <span class="mx-2">|</span>
            <span>{{ $article->created_at->format('Y-m-d H:i:s') }}</span>
        </div>

        @auth
            @if(auth()->user()->id === $article->user_id || auth()->user()->is_admin)
                <div class="mb-3">
                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-sm btn-warning">Szerkesztés</a>
                    @if(auth()->user()->is_admin)
                        <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Biztosan törölni szeretnéd ezt a cikket?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Törlés</button>
                        </form>
                    @endif
                </div>
            @endif
        @endauth
    </header>

    <div class="lead mb-4 text-muted">
        {{ $article->lead }}
    </div>

    <div class="article-body" style="white-space: pre-line; line-height: 1.6;">{{ $article->body }}</div>
</article>
@endsection
