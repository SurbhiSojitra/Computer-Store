@extends('layout.app')

@section('title', 'Home')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endpush

@section('content')
<section class="product-page">
    <div class="product-wrapper">

        <div class="productdetail-image">
            <img src="{{ asset($product->image) }}" alt="">
        </div>

        <div class="product-info">

            <p class="product-category">{{$product->category}}</p>

            <h1 class="product-title">{{$product->name}}</h1>

            <h2 class="product-price">{{$product->price}}</h2>

            <p class="product-description">{{$product->name}}</p>

            <p class="product-description">{{ $product->description}}</p>

            <form action="{{ route('add.to.cart', $product->id) }}" method="POST">
                @csrf
                <div class="qty-cart">
                    <input type="number" name="quantity" value="1" min="1">
                    <button type="submit" class="btn btn-add btn-dark">Add to Cart</button>
                </div>
            </form>

            <!-- <p class="product-stock">
                <span class="dot"></span> In Stock ({{ $product->stock }})
            </p> -->

            <p class="product-stock"
                style="color: {{ $product->stock > 0 ? 'green' : 'red' }};">

                <span class="dot"
                    style="background: {{ $product->stock > 0 ? 'green' : 'red' }};">
                </span>

                @if($product->stock > 0)
                In Stock ({{ $product->stock }})
                @else
                Out of Stock
                @endif

            </p>

        </div>
    </div>
</section>

@endsection