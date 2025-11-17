@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check-circle text-success success-icon" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                    </svg>
                </div>

                <h2 class="mb-3">Köszönjük a rendelését!</h2>
                <p class="lead mb-4">Rendelése sikeresen rögzítésre került.</p>

                <div class="alert alert-info d-inline-block">
                    <strong>Rendelésszám:</strong> #{{ $order->id }}
                </div>

                <div class="row mt-5">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                <h5 class="mb-0">Rendelés részletei</h5>
                            </div>
                            <div class="card-body text-start">
                                <p><strong>Név:</strong> {{ $order->customer_name }}</p>
                                <p><strong>E-mail:</strong> {{ $order->customer_email }}</p>
                                <p><strong>Telefonszám:</strong> {{ $order->customer_phone }}</p>
                                <hr>
                                <p><strong>Szállítási cím:</strong><br>
                                    {{ $order->shipping_zip }} {{ $order->shipping_city }}<br>
                                    {{ $order->shipping_address }}
                                </p>
                                <p><strong>Szállítási mód:</strong> {{ $order->shipping_method }}</p>
                                <p><strong>Fizetési mód:</strong> {{ $order->payment_method }}</p>
                                <hr>
                                <p><strong>Végösszeg:</strong> <span class="text-primary fs-5">{{ number_format($order->total_amount, 0, ',', ' ') }} Ft</span></p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('shop.index') }}" class="btn btn-primary btn-lg w-100">
                                Vissza a nyitólapra
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
