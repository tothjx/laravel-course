@extends('layouts.app')

@section('title', 'Felhasználók - AnotherNews')

@section('content')
<h1 class="mb-4">Felhasználók</h1>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Név</th>
                <th>Email</th>
                <th>Szerepkör</th>
                <th>Cikkek száma</th>
                <th>Értesítés</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->is_admin)
                            <span class="badge bg-danger">Admin</span>
                        @else
                            <span class="badge bg-secondary">User</span>
                        @endif
                    </td>
                    <td>{{ $user->articles_count }}</td>
                    <td>
                        @if($user->subscribed_to_notifications)
                            <span class="badge bg-success">Feliratkozott</span>
                        @else
                            <span class="badge bg-warning">Nem iratkozott fel</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-primary">Megtekintés</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    {{ $users->links() }}
</div>
@endsection
