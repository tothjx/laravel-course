@extends('layouts.app')

@section('title', 'Belépés - AnotherNews')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Belépés</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email cím</label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Jelszó</label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Emlékezz rám
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Belépés</button>
                </form>

                <hr class="my-4">

                <div class="alert alert-info mb-0">
                    <strong>Teszt felhasználók:</strong><br>
                    Admin: admin1@example.com / password<br>
                    Admin: admin2@example.com / password<br>
                    Vagy bármely más generált felhasználó / password
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
