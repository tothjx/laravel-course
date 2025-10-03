@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    <!-- Alert komponens -->
    <div class="uk-alert uk-alert-primary" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        Üdvözlünk az oldalon!
    </div>

    @php
        $blogPosts = [
            [
                'title' => 'Laravel Blade komponensek használata',
                'image' => 'https://picsum.photos/400/250?random=1',
                'date' => '2024-01-15',
                'excerpt' => 'Ismerd meg a Laravel Blade komponensek erejét és hogyan lehet velük hatékonyan dolgozni a projektjeidben.'
            ],
            [
                'title' => 'Modern webfejlesztés UIKit-tel',
                'image' => 'https://picsum.photos/400/250?random=2',
                'date' => '2024-01-10',
                'excerpt' => 'A UIKit CSS framework bemutatása és praktikus tippek a használatához modern weboldalak készítéséhez.'
            ],
            [
                'title' => 'PHP 8 újdonságai és fejlesztési tippek',
                'image' => 'https://picsum.photos/400/250?random=3',
                'date' => '2024-01-05',
                'excerpt' => 'Fedezd fel a PHP 8 legújabb funkcióit és tanulj meg hatékonyabb kódot írni a modern PHP fejlesztésben.'
            ]
        ];
    @endphp

    <!-- Blog bejegyzések -->
    <div class="uk-section">
        <div class="uk-container">
            <h1 class="uk-heading-medium uk-text-center uk-margin-large-bottom">Blog Bejegyzések</h1>

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
                    <p class="uk-text-large uk-text-muted">Még nincsenek bejegyzések</p>
                </div>
            @endif
        </div>
    </div>
@endsection