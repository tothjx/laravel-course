@extends('layouts.app')

@section('title', 'Új cikk írása - AnotherNews')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="mb-4">
            <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary">&larr; Vissza</a>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Új cikk írása</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('articles.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Cím *</label>
                        <input type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               id="title"
                               name="title"
                               value="{{ old('title') }}"
                               maxlength="255"
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lead" class="form-label">Bevezető (Lead) *</label>
                        <textarea class="form-control @error('lead') is-invalid @enderror"
                                  id="lead"
                                  name="lead"
                                  rows="3"
                                  required>{{ old('lead') }}</textarea>
                        @error('lead')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Rövid, 1 bekezdéses összefoglaló a cikkről.</div>
                    </div>

                    <div class="mb-3">
                        <label for="body" class="form-label">Cikk törzse *</label>
                        <textarea class="form-control @error('body') is-invalid @enderror"
                                  id="body"
                                  name="body"
                                  rows="15"
                                  maxlength="5000"
                                  required>{{ old('body') }}</textarea>
                        @error('body')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Maximum 5000 karakter. Tiltott szavak nem használhatók.</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Mégse</a>
                        <button type="submit" class="btn btn-primary">Cikk közzététele</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
