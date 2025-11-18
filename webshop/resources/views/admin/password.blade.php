@extends('admin.layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0"><i class="bi bi-key"></i> Jelszó módosítása</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Jelenlegi jelszó</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                               id="current_password" name="current_password" required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Új jelszó</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">A jelszónak legalább 8 karakter hosszúnak kell lennie.</div>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Új jelszó megerősítése</label>
                        <input type="password" class="form-control"
                               id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> A jelszó megváltoztatása után újra be kell jelentkezned.
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save"></i> Jelszó módosítása
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Vissza
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
