@extends('layouts.app')

@section('title', $user->name . ' - Felhasználó - AnotherNews')

@section('content')
<div class="mb-4">
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">&larr; Vissza a felhasználókhoz</a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h2 class="card-title mb-2">{{ $user->name }}</h2>
                <p class="text-muted mb-2">{{ $user->email }}</p>
                <div class="mb-2">
                    @if($user->is_admin)
                        <span class="badge bg-danger">Admin</span>
                    @else
                        <span class="badge bg-secondary">User</span>
                    @endif
                    @if($user->subscribed_to_notifications)
                        <span class="badge bg-success">Értesítésekre feliratkozott</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<h3 class="mb-3">{{ $user->name }} cikkei ({{ $user->articles->count() }})</h3>

@forelse($user->articles as $article)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('articles.show', $article) }}" class="text-decoration-none text-dark">
                    {{ $article->title }}
                </a>
            </h5>

            <p class="text-muted small mb-2">{{ $article->created_at->format('Y-m-d H:i:s') }}</p>

            <p class="card-text text-muted">{{ Str::limit($article->lead, 150) }}</p>

            <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-outline-primary">Tovább olvasom</a>
        </div>
    </div>
@empty
    <div class="alert alert-info">
        Ez a felhasználó még nem írt cikket.
    </div>
@endforelse
@endsection
