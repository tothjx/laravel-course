@extends('layouts.app')

@section('title', 'Főoldal')

@section('content')
    <div class="uk-section">
        <div class="uk-container">
            <!-- Üdvözlő szöveg -->
            <div class="uk-text-center uk-margin-large-bottom">
                <h1 class="uk-heading-primary">Üdvözöljük a Blog Two oldalon!</h1>
            </div>

            <!-- Bemutatkozó bekezdés -->
            <div class="uk-width-2-3@m uk-margin-auto uk-margin-large-bottom">
                <p class="uk-text-lead uk-text-center">
                    Ez egy modern blog platform, ahol érdekes cikkeket, gondolatokat és
                    tapasztalatokat osztunk meg. Fedezd fel a legfrissebb bejegyzéseinket,
                    és csatlakozz a közösségünkhöz!
                </p>
            </div>

            <!-- Tovább a bloghoz gomb -->
            <div class="uk-text-center">
                <a href="{{ route('blog') }}" class="uk-button uk-button-primary uk-button-large">
                    Tovább a bloghoz
                </a>
            </div>
        </div>
    </div>
@endsection