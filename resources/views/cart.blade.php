@extends('layout.app')

@section('title', 'Home')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">
@endpush

@section('content')

{{-- UPDATE CART FORM START --}}
<form action="{{ route('cart.update') }}" method="POST">
    @csrf

    <section>
        <div class="container">
            <div class="heading mt-3">
                <h2>Shopping Cart</h2>
            </div>

            <div class="cartTable">
                <table class="mt-2">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>SubTotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($cartItems as $item)
                        <tr>
                            <td class="d-flex">
                                <div class="image">
                                    <img src="{{ asset($item->product->image) }}" alt="">
                                </div>
                                <div class="name fw-bold px-3">{{ $item->product->name }}</div>
                            </td>

                            <td>${{ number_format($item->price) }}</td>

                            <td>
                                <input type="number" name="quantities[{{ $item->id }}]"
                                    value="{{ $item->quantity }}"
                                    min="1"
                                    class="form-control"
                                    style="width: 70px;">
                            </td>

                            <td>${{ number_format($item->subtotal) }}</td>

                            <td>
                                <button type="submit"
                                    class="btn btn-danger"
                                    formmethod="POST"
                                    formaction="{{ route('cart.delete', $item->id) }}"
                                    onclick="return confirm('Delete item?')">
                                    Delete
                                </button>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="total mt-3">
                <h5>Total: ${{ number_format($total) }}</h5>
            </div>
            <div class="buttons">
                <button type="submit" class="btn btn-success mt-4 mb-5">Update Cart</button>
                <a href="{{ route('checkout') }}" class="btn btn-info mt-2 mb-5">
                    Proceed to Checkout
                </a>
            </div>
        </div>
    </section>
</form>
@endsection