@extends('layout.app')

@section('title', 'Home')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endpush

@section('content')

<form action="{{ route('checkout.placeOrder') }}" method="POST">
    @csrf
    <input type="hidden" name="total_price" value="{{ $total }}">
    <section>
        <div class="container">
            <div class="heading mt-3 mb-5">
                <h4>Checkout</h4>
            </div>
            <div class="checkout mb-5">
                <div class="row">
                    <div class="col-md-6 order">
                        <h4 class="mb-3">Order Summary</h4>
                        <div class="checkoutcart">
                            @foreach ($cartItems as $item)
                            <div class="checkoutproducts">
                                <div class="checkoutdetail">
                                    {{ $item->product->name }} x {{ $item->quantity }}
                                </div>
                                <div class="pricedetail">
                                    ${{ number_format($item->subtotal) }}
                                </div>
                            </div>
                            <hr>
                            @endforeach
                            <div class="checkoutproducts totalcheckout">
                                <div class="checkoutdetail fw-bold">Total</div>
                                <div class="pricedetail fw-bold">${{ number_format($total) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Shipping Information</h4>
                        <div class="shipping">
                            <div class="form-group mb-3">
                                <label>Full Name</label>
                                <input type="text" name="full_name" class="form-control"
                                    value="{{ auth()->user()->name }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>Address</label>
                                <textarea name="address"
                                    class="form-control"
                                    required
                                    rows="3"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label>Payment Method</label>
                                <select name="payment_method" class="form-control">
                                    <option>Credit Card (Mock)</option>
                                    <option>PayPal (Mock)</option>
                                    <option>Cash on Delivery</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary confirm">
                                Confirm Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
@endsection