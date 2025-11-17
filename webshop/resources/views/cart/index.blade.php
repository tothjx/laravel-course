@extends('layouts.app')

@section('content')
    <div class="col-12">
        <h2 class="mb-4">Kosár</h2>

        @if(count($cart) > 0)
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Termék</th>
                                        <th class="text-center">Ár</th>
                                        <th class="text-center">Mennyiség</th>
                                        <th class="text-end">Összesen</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $id => $item)
                                        <tr>
                                            <td>
                                                <strong>{{ $item['name'] }}</strong>
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($item['price'], 0, ',', ' ') }} Ft
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="action" value="decrease">
                                                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <span class="btn btn-sm btn-outline-secondary disabled">
                                                        {{ $item['quantity'] }}
                                                    </span>
                                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="action" value="increase">
                                                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <strong>{{ number_format($item['price'] * $item['quantity'], 0, ',', ' ') }} Ft</strong>
                                            </td>
                                            <td class="text-end">
                                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Összesítés</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <span>Termékek száma:</span>
                                <strong>{{ array_sum(array_column($cart, 'quantity')) }} db</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Végösszeg:</span>
                                <strong class="fs-4 text-primary">{{ number_format($total, 0, ',', ' ') }} Ft</strong>
                            </div>
                            <hr>
                            <a href="{{ route('order.checkout') }}" class="btn btn-success w-100 btn-lg">
                                Tovább a rendeléshez
                            </a>
                        </div>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary w-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                            </svg>
                            Vissza a vásárláshoz
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-light">
                <h4 class="alert-heading">A kosár üres</h4>
                <p>Jelenleg nincsenek termékek a kosárban.</p>
                <hr>
                <a href="{{ route('shop.index') }}" class="btn btn-success">
                    Vissza a termékekhez
                </a>
            </div>
        @endif
    </div>
@endsection
