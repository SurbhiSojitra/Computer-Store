@extends('layout.app')

@section('title', 'Home')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">
@endpush

@section('content')

<section class="success-wrapper">
    <div class="successcard">
        <h1><i class="bi bi-check-circle-fill"></i></h1>
        <h2>Order Placed Successfully!</h2>
        <p>Thank you for your purchase.</p>
        <p>Order ID: #{{ $order->id }}</p>
        <h4>Order Summary</h4>
        <div class="checkdetali">
            @foreach ($order->items as $item)
            <div class="checkoutproducts">
                <div class="checkoutdetail">{{ $item->product->name }} x {{ $item->quantity }}</div>
                <div class="pricedetail"> ${{ number_format($item->subtotal) }}</div>
            </div>
            <hr>
            @endforeach
            <div class="checkoutproducts totalcheckout">
                <div class="checkoutdetail fw-bold">Total</div>
                <div class="pricedetail fw-bold"> ${{ number_format($order->total_price) }}</div>
            </div>
        </div>

        <a href="{{ route('home') }}" class="btn btn-info shoppingbtn mt-4">Continue Shopping</a>
    </div>
</section>
@endsection