@extends('admin.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="bi bi-speedometer2"></i> Dashboard</h1>
            <div class="text-muted">
                Üdvözöljük, <strong>{{ Auth::user()->name }}</strong>!
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card border-primary">
            <div class="card-body bg-primary bg-opacity-10">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-primary">Összes rendelés</h6>
                        <h2 class="card-title mb-0 text-dark">{{ \App\Models\Order::count() }}</h2>
                    </div>
                    <div>
                        <i class="bi bi-cart-check text-primary" style="font-size: 3rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-primary">
                <a href="{{ route('admin.orders') }}" class="text-primary text-decoration-none">
                    Megtekintés <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-success">
            <div class="card-body bg-success bg-opacity-10">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-success">Mai rendelések</h6>
                        <h2 class="card-title mb-0 text-dark">{{ \App\Models\Order::whereDate('created_at', today())->count() }}</h2>
                    </div>
                    <div>
                        <i class="bi bi-calendar-check text-success" style="font-size: 3rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-success">
                <small class="text-dark">Ma érkezett</small>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-info">
            <div class="card-body bg-info bg-opacity-10">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-info">Olvasatlan értesítések</h6>
                        <h2 class="card-title mb-0 text-dark">{{ Auth::user()->unreadNotifications->count() }}</h2>
                    </div>
                    <div>
                        <i class="bi bi-bell text-info" style="font-size: 3rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-info">
                <small class="text-dark">Új értesítések</small>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Legutóbbi rendelések</h5>
            </div>
            <div class="card-body">
                @php
                    $recentOrders = \App\Models\Order::orderBy('created_at', 'desc')->limit(5)->get();
                @endphp

                @if($recentOrders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Vásárló neve</th>
                                    <th>Email</th>
                                    <th>Összeg</th>
                                    <th>Fizetési mód</th>
                                    <th>Dátum</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td><strong>#{{ $order->id }}</strong></td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->customer_email }}</td>
                                        <td><strong>{{ number_format($order->total_amount, 0, ',', ' ') }} Ft</strong></td>
                                        <td>
                                            @if($order->payment_method === 'készpénz')
                                                <span class="badge bg-success">Készpénz</span>
                                            @else
                                                <span class="badge bg-primary">Bankkártya</span>
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.orders') }}" class="btn btn-primary">
                            <i class="bi bi-list"></i> Összes rendelés megtekintése
                        </a>
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-info-circle"></i> Még nincsenek rendelések az adatbázisban.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
