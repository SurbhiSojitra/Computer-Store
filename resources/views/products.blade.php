@extends('layout.app')

@section('title', 'Home')

@push('styles')

@endpush

@section('content')
<section>
    <div class="container">
        <div class="All-products mt-5">
            <h1>All Products</h1>

            <form method="GET" action="{{ route('products') }}">
                <div class="row d-flex justify-content-end align-items-center mb-4 mt-3">

                    <div class="col-md-2 mb-2" style="width: 200px;">
                        <input type="text"
                            name="search"
                            class="form-control search-input"
                            placeholder="Search..."
                            value="{{ request('search') }}">
                    </div>

                    <div class="col-md-2 mb-2" style="width: 200px;">
                        <select name="category" class="form-select">
                            <option value="">All Categories</option>
                            <option value="Laptops" {{ request('category')=='Laptops'?'selected':'' }}>Laptops</option>
                            <option value="Accessories" {{ request('category')=='Accessories'?'selected':'' }}>Accessories</option>
                            <option value="Mobiles" {{ request('category')=='Mobiles'?'selected':'' }}>Mobiles</option>
                        </select>
                    </div>

                    <div class="col-md-2 mb-2" style="width: 100px;">
                        <button class="btn btn-primary w-100 filter-btn">Filter</button>
                    </div>

                </div>
            </form>

        </div>
        <div class="products">

            @foreach($products as $p)
            <div class="products-card mb-5">
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
</section>

@endsection