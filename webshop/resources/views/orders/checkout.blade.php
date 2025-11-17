@extends('layouts.app')

@section('content')
    <div class="col-12">
        <h2 class="mb-4">Rendelés leadása</h2>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf

                            <h5 class="mb-3">Vásárló adatai</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="customer_name" class="form-label">Név</label>
                                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                                           id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                                    @error('customer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="customer_email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control @error('customer_email') is-invalid @enderror"
                                           id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required>
                                    @error('customer_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="customer_phone" class="form-label">Telefonszám</label>
                                <input type="text" class="form-control @error('customer_phone') is-invalid @enderror"
                                       id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required>
                                @error('customer_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <h5 class="mb-3">Számlázási adatok</h5>
                            <div class="mb-3">
                                <label for="billing_address" class="form-label">Cím</label>
                                <input type="text" class="form-control @error('billing_address') is-invalid @enderror"
                                       id="billing_address" name="billing_address" value="{{ old('billing_address') }}" required>
                                @error('billing_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="billing_city" class="form-label">Város</label>
                                    <input type="text" class="form-control @error('billing_city') is-invalid @enderror"
                                           id="billing_city" name="billing_city" value="{{ old('billing_city') }}" required>
                                    @error('billing_city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="billing_zip" class="form-label">Irányítószám</label>
                                    <input type="text" class="form-control @error('billing_zip') is-invalid @enderror"
                                           id="billing_zip" name="billing_zip" value="{{ old('billing_zip') }}" required>
                                    @error('billing_zip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="sameAsShipping" onchange="copyBillingToShipping()">
                                <label class="form-check-label" for="sameAsShipping">
                                    Szállítási cím megegyezik a számlázási címmel
                                </label>
                            </div>

                            <h5 class="mb-3">Szállítási adatok</h5>
                            <div class="mb-3">
                                <label for="shipping_address" class="form-label">Cím</label>
                                <input type="text" class="form-control @error('shipping_address') is-invalid @enderror"
                                       id="shipping_address" name="shipping_address" value="{{ old('shipping_address') }}" required>
                                @error('shipping_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="shipping_city" class="form-label">Város</label>
                                    <input type="text" class="form-control @error('shipping_city') is-invalid @enderror"
                                           id="shipping_city" name="shipping_city" value="{{ old('shipping_city') }}" required>
                                    @error('shipping_city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="shipping_zip" class="form-label">Irányítószám</label>
                                    <input type="text" class="form-control @error('shipping_zip') is-invalid @enderror"
                                           id="shipping_zip" name="shipping_zip" value="{{ old('shipping_zip') }}" required>
                                    @error('shipping_zip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr class="my-4">

                            <h5 class="mb-3">Szállítási mód</h5>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shipping_method"
                                           id="shipping_home" value="házhoz szállítás"
                                           {{ old('shipping_method') == 'házhoz szállítás' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="shipping_home">
                                        Házhoz szállítás
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shipping_method"
                                           id="shipping_store" value="boltban átvétel"
                                           {{ old('shipping_method') == 'boltban átvétel' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="shipping_store">
                                        Boltban átvétel
                                    </label>
                                </div>
                                @error('shipping_method')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <h5 class="mb-3">Fizetési mód</h5>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method"
                                           id="payment_cash" value="készpénz"
                                           {{ old('payment_method') == 'készpénz' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="payment_cash">
                                        Készpénz
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method"
                                           id="payment_card" value="bankkártya"
                                           {{ old('payment_method') == 'bankkártya' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="payment_card">
                                        Bankkártya
                                    </label>
                                </div>
                                @error('payment_method')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg">Rendelés véglegesítése</button>
                                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">Vissza a kosárhoz</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Rendelés összesítő</h5>
                    </div>
                    <div class="card-body">
                        @foreach($cart as $id => $item)
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                                <strong>{{ number_format($item['price'] * $item['quantity'], 0, ',', ' ') }} Ft</strong>
                            </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span>Végösszeg:</span>
                            <strong class="fs-4 text-primary">{{ number_format($total, 0, ',', ' ') }} Ft</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyBillingToShipping() {
            const checkbox = document.getElementById('sameAsShipping');
            if (checkbox.checked) {
                document.getElementById('shipping_address').value = document.getElementById('billing_address').value;
                document.getElementById('shipping_city').value = document.getElementById('billing_city').value;
                document.getElementById('shipping_zip').value = document.getElementById('billing_zip').value;
            } else {
                document.getElementById('shipping_address').value = '';
                document.getElementById('shipping_city').value = '';
                document.getElementById('shipping_zip').value = '';
            }
        }
    </script>
@endsection
