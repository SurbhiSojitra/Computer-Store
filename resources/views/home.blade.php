@extends('layout.app')

@section('title', 'Home')

@push('styles')
@endpush

@section('content')
<section>
    <div class="container">
        <div class="hero-section mt-5 mb-3">
            <div class="hero-heading">
                <h1>Next-Gen Computing Starts Here</h1>
                <p class="mt-4">
                    Discover the latest laptops, desktops, and accessories for professionals and gamers.
                </p>
                <a href="{{route('products')}}" class="btn btn-dark mt-4">Shop Now</a>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="feature-products">
            <h1>Featured Products</h1>
        </div>

        <div class="products">
            @foreach($featured as $p)
            <div class="products-card mt-5 mb-5">
                <div class="product-image">
                    <img src="{{ asset($p->image) }}" alt="">
                </div>

                <div class="product-info p-4">
                    <div class="category py-2">{{ $p->category }}</div>
                    <h4 class="name">{{ $p->name }}</h4>
                    <div class="price py-2">₹{{ $p->price }}</div>
                    <a href="{{route('productDetails', $p->id)}}" class="btn btn-outline-dark w-100">View Details</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection