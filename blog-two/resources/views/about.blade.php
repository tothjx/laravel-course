@extends('layouts.app')

@section('title', 'Rólunk')

@section('content')
    <div class="uk-section">
        <div class="uk-container">
            <!-- Címsor -->
            <div class="uk-text-center uk-margin-large-bottom">
                <h1 class="uk-heading-primary">Rólunk</h1>
            </div>

            <!-- Tartalom -->
            <div class="uk-width-2-3@m uk-margin-auto">
                <div class="uk-card uk-card-default uk-card-body">
                    <p class="uk-text-lead">
                        Üdvözöljük a Blog Two oldalon! Mi egy lelkes csapat vagyunk, akik szenvedélyesen
                        foglalkoznak a modern webfejlesztéssel és szeretjük megosztani tudásunkat a közösséggel.
                    </p>

                    <p>
                        Blogunk célja, hogy hasznos információkat, gyakorlati tippeket és érdekes cikkeket
                        osszunk meg a webfejlesztés világából. Legyen szó Laravel keretrendszerről,
                        modern CSS technikákról vagy PHP fejlesztésről - nálunk mindig találsz valamit.
                    </p>

                    <p>
                        Hiszünk abban, hogy a tudás megosztása által mindannyian fejlődhetünk.
                        Csatlakozz hozzánk, és fedezd fel a webfejlesztés izgalmas világát!
                    </p>

                    <div class="uk-margin-medium-top">
                        <h3>Miért válassz minket?</h3>
                        <ul class="uk-list uk-list-bullet">
                            <li>Aktuális és releváns tartalom</li>
                            <li>Gyakorlati példák és kódminták</li>
                            <li>Barátságos közösség</li>
                            <li>Rendszeres frissítések</li>
                        </ul>
                    </div>

                    <div class="uk-text-center uk-margin-medium-top">
                        <a href="{{ route('blog') }}" class="uk-button uk-button-primary">
                            Böngéssz a bejegyzések között
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection