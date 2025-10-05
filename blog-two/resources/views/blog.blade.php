@extends('layouts.app')

@section('title', 'Blog')

@push('scripts')
    <script src="{{ asset('js/main.js') }}"></script>
@endpush

@section('content')
    <div class="uk-alert uk-alert-primary" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        Welcome to the blog!
    </div>

    <div class="uk-section uk-section-no-padding">
        <div class="uk-container">
            <h1 class="uk-heading-medium uk-text-center h1-normal">Blog posts</h1>

            @if(count($blogPosts) > 0)
                <div class="uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>
                    @foreach($blogPosts as $post)
                        <div>
                            <div class="uk-card uk-card-default uk-card-hover uk-margin">
                                <div class="uk-card-media-top">
                                    <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" uk-img>
                                </div>
                                <div class="uk-card-body">
                                    <h3 class="uk-card-title">{{ $post['title'] }}</h3>
                                    <p class="uk-text-meta uk-margin-remove-top">
                                        <time datetime="{{ $post['date'] }}">{{ $post['date'] }}</time>
                                    </p>
                                    <div class="uk-margin-top">
                                        {{ $post['excerpt'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="uk-text-center uk-margin-large">
                    <p class="uk-text-large uk-text-muted">post not found</p>
                </div>
            @endif
        </div>
    </div>
@endsection