@extends('admin.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-cart-check"></i> Összes rendelés</h4>
                <span class="badge bg-light text-dark">{{ $orders->total() }} rendelés</span>
            </div>
            <div class="card-body">
                @if($orders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Vásárló neve</th>
                                    <th>Email</th>
                                    <th>Telefon</th>
                                    <th>Összeg</th>
                                    <th>Fizetési mód</th>
                                    <th>Szállítási mód</th>
                                    <th>Státusz</th>
                                    <th>Dátum</th>
                                    <th>Műveletek</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td><strong>#{{ $order->id }}</strong></td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->customer_email }}</td>
                                        <td>{{ $order->customer_phone }}</td>
                                        <td><strong>{{ number_format($order->total_amount, 0, ',', ' ') }} Ft</strong></td>
                                        <td>
                                            @if($order->payment_method === 'készpénz')
                                                <span class="badge bg-success">Készpénz</span>
                                            @else
                                                <span class="badge bg-primary">Bankkártya</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->shipping_method === 'házhoz szállítás')
                                                <span class="badge bg-info">Házhoz szállítás</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Boltban átvétel</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->status === 'completed')
                                                <span class="badge bg-success">Teljesítve</span>
                                            @elseif($order->status === 'processing')
                                                <span class="badge bg-warning text-dark">Feldolgozás alatt</span>
                                            @elseif($order->status === 'cancelled')
                                                <span class="badge bg-danger">Törölve</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">
                                                <i class="bi bi-eye"></i> Részletek
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Order Details Modals -->
                    @foreach($orders as $order)
                        <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">Rendelés #{{ $order->id }} részletei</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6><i class="bi bi-person"></i> Vásárló adatai</h6>
                                                <p class="mb-1"><strong>Név:</strong> {{ $order->customer_name }}</p>
                                                <p class="mb-1"><strong>Email:</strong> {{ $order->customer_email }}</p>
                                                <p class="mb-3"><strong>Telefon:</strong> {{ $order->customer_phone }}</p>

                                                <h6><i class="bi bi-credit-card"></i> Számlázási cím</h6>
                                                <p class="mb-1">{{ $order->billing_address }}</p>
                                                <p class="mb-3">{{ $order->billing_zip }} {{ $order->billing_city }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6><i class="bi bi-truck"></i> Szállítási adatok</h6>
                                                <p class="mb-1"><strong>Mód:</strong>
                                                    @if($order->shipping_method === 'házhoz szállítás')
                                                        Házhoz szállítás
                                                    @else
                                                        Boltban átvétel
                                                    @endif
                                                </p>
                                                <p class="mb-1">{{ $order->shipping_address }}</p>
                                                <p class="mb-3">{{ $order->shipping_zip }} {{ $order->shipping_city }}</p>

                                                <h6><i class="bi bi-cash"></i> Fizetési mód</h6>
                                                <p class="mb-3">
                                                    @if($order->payment_method === 'készpénz')
                                                        Készpénz
                                                    @else
                                                        Bankkártya
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                        <hr>

                                        <h6><i class="bi bi-bag"></i> Rendelt termékek</h6>
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Termék</th>
                                                        <th>Ár</th>
                                                        <th>Mennyiség</th>
                                                        <th>Összeg</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order->items as $item)
                                                        <tr>
                                                            <td>{{ $item['name'] }}</td>
                                                            <td>{{ number_format($item['price'], 0, ',', ' ') }} Ft</td>
                                                            <td>{{ $item['quantity'] }}</td>
                                                            <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', ' ') }} Ft</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3" class="text-end"><strong>Végösszeg:</strong></td>
                                                        <td><strong>{{ number_format($order->total_amount, 0, ',', ' ') }} Ft</strong></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezárás</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-4">
                        {{ $orders->links('pagination::bootstrap-5') }}
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
