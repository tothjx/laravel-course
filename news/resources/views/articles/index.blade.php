@extends('layouts.app')

@section('title', 'Cikkek - AnotherNews')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Legfrissebb cikkek</h1>
    @auth
        <a href="{{ route('articles.create') }}" class="btn btn-primary">Új cikk írása</a>
    @endauth
</div>

@forelse($articles as $article)
    <div class="card mb-3">
        <div class="card-body">
            <h3 class="card-title">
                <a href="{{ route('articles.show', $article) }}" class="text-decoration-none text-dark">
                    {{ $article->title }}
                </a>
            </h3>

            <div class="mb-2 text-muted small">
                <span>Szerző: <a href="{{ route('users.show', $article->user) }}">{{ $article->user->name }}</a></span>
                <span class="mx-2">|</span>
                <span>{{ $article->created_at->format('Y-m-d H:i:s') }}</span>
            </div>

            <p class="card-text text-muted">{{ $article->lead }}</p>

            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-outline-primary">Tovább olvasom</a>

                @auth
                    @if(auth()->user()->id === $article->user_id || auth()->user()->is_admin)
                        <div>
                            <a href="{{ route('articles.edit', $article) }}" class="btn btn-sm btn-outline-secondary">Szerkesztés</a>
                            @if(auth()->user()->is_admin)
                                <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Biztosan törölni szeretnéd ezt a cikket?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Törlés</button>
                                </form>
                            @endif
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-info">
        Még nincsenek cikkek.
    </div>
@endforelse

<div class="mt-4">
    {{ $articles->links() }}
</div>
@endsection
