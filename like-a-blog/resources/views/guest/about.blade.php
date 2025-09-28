@extends('layouts.guest')

@section('title', 'Névjegy - ' . config('blog.app_name'))

@section('content')
<div class="about-page">
    <div class="page-header">
        <h1 class="page-title">Névjegy</h1>
    </div>

    <div class="about-content">
        <div class="about-card">
            <div class="about-info">
                <h2 class="about-name">{{ $name }}</h2>

                <div class="contact-info">
                    <div class="contact-item">
                        <strong>Email:</strong> {{ $email }}
                    </div>
                    <div class="contact-item">
                        <strong>Telefon:</strong> {{ $phone }}
                    </div>
                </div>

                <div class="skills-section">
                    <h3>Készségek</h3>
                    <ul class="skills-list">
                        @foreach($skills as $skill)
                            <li>{{ $skill }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="description-section">
                    <h3>Bemutatkozás</h3>
                    <p class="description-text">{{ $description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection