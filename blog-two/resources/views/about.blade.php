@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="uk-section uk-section-no-padding">
        <div class="uk-container">
            <div class="uk-text-center">
                <h1 class="uk-heading-primary">{{ $title }}</h1>
            </div>

            <div class="uk-width-2-3@m uk-margin-auto">
                <div class="uk-card uk-card-default uk-card-body">
                    <p class="uk-text-lead">
                        {{ $introduction }}
                    </p>

                    <p>
                        <img src="{{ $urlImage }}" alt="image">
                    </p>

                    <p style="text-align: justify;">
                        {{ $description }}
                    </p>

                    <p>
                        {{ $mission }}
                    </p>

                    <div class="uk-margin-medium-top">
                        <h3>{{ $featuresTitle }}</h3>
                        <ul class="uk-list uk-list-bullet">
                            @foreach($features as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="uk-text-center uk-margin-medium-top">
                        <a href="{{ route('blog') }}" class="uk-button uk-button-primary">
                            continue to the blog
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection