@extends('layouts.app')

@section('title', 'home')

@section('content')
    <div class="uk-section uk-section-no-padding">
        <div class="uk-container">
            <div class="uk-text-center">
                <h1 class="uk-heading-primary">{{ $title }}</h1>
            </div>

            <div class="uk-width-2-3@m uk-margin-auto">
                <p class="uk-text-lead uk-text-justify">
                    {{ $content }}
                </p>
            </div>

            <div class="uk-text-center">
                <a href="{{ route('blog') }}" class="uk-button uk-button-primary uk-button-large">
                    Go to the blog
                </a>
            </div>
        </div>
    </div>
@endsection