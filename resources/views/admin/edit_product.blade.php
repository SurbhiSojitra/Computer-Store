@extends('layout.app')

@section('title', 'Edit Product')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
@endpush

@section('content')
<section class="form-wrapper mb-5">
    <div class="productAdd">
        <div class="productHeading p-4">
            <h3>Edit Product</h3>
        </div>

        <form action="{{ route('admin.updateProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 px-4">
                <label>Product Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}">
            </div>

            <div class="mb-3 px-4">
                <label>Product Image</label>
                <input type="file" name="image" class="form-control">
                @if($product->image)
                <img src="{{ asset($product->image) }}" width="100" class="mt-2">
                @endif
            </div>

            <div class="mb-3 px-4">
                <label>Price</label>
                <input type="number" name="price" class="form-control" value="{{ $product->price }}">
            </div>

            <div class="mb-3 px-4">
                <label>Category</label>
                <select name="category" class="form-control">
                    <option {{ $product->category=='Laptops'?'selected':'' }}>Laptops</option>
                    <option {{ $product->category=='Desktops'?'selected':'' }}>Desktops</option>
                    <option {{ $product->category=='Accessories'?'selected':'' }}>Accessories</option>
                    <option {{ $product->category=='Components'?'selected':'' }}>Components</option>
                </select>
            </div>

            <div class="mb-3 px-4">
                <label>Stock</label>
                <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
            </div>

            <div class="mb-3 px-4">
                <label>Description</label>
                <textarea name="desc" class="form-control">{{ $product->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-dark m-4">Update Product</button>
        </form>
    </div>
</section>
@endsection