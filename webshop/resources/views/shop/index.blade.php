@extends('layouts.app')

@section('content')
    <div class="col-md-3">
        <div class="card">
            <div class="card-header bg-light text-black">
                <h5 class="mb-0">Termék-kategóriák szerint</h5>
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('shop.index') }}" class="list-group-item list-group-item-action {{ !isset($category) ? 'active' : '' }}">
                    Összes termék
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('shop.category', $cat->slug) }}"
                       class="list-group-item list-group-item-action {{ isset($category) && $category->id == $cat->id ? 'active' : '' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <h2 class="mb-4">
            @if(isset($category))
                {{ $category->name }}
            @else
                Összes termék
            @endif
        </h2>

        @if($products->count() > 0)
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($products as $product)
                    <div class="col">
                        <div class="card h-100">
                            @if($product->image)
                                <div class="product-image-container">
                                    <img src="{{ asset($product->image) }}" class="card-img-top product-image" alt="{{ $product->name }}">
                                </div>
                            @else
                                <div class="card-img-top bg-secondary product-image-placeholder">
                                    <span class="text-white">Nincs kép</span>
                                </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-muted small">{{ Str::limit($product->description, 80) }}</p>
                                <div class="mt-auto">
                                    <p class="card-text">
                                        <strong class="text-success fs-4">{{ number_format($product->price, 0, ',', ' ') }} Ft</strong>
                                    </p>
                                    <p class="card-text">
                                        <small class="text-muted">Raktáron: {{ $product->stock }} db</small>
                                    </p>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        @if($product->stock > 0)
                                            <button type="submit" class="btn btn-success w-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                                </svg>
                                                Kosárba
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-secondary w-100" disabled>Nincs készleten</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                Ebben a kategóriában jelenleg nincsenek elérhető termékek.
            </div>
        @endif
    </div>
@endsection
