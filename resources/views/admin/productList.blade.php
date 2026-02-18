@extends('layout.app')

@section('title', 'Home')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
@endpush

@section('content')
<section class="form-wrapper mb-5">
    <div class="productAdd">
        <div class="productHeading p-4">
            <h3>Add New Product</h3>
        </div>

        <form action="{{ route('admin.storeProduct') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 px-4">
                <label class="label-control">Product Name</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="mb-3 px-4">
                <label class="label-control">Product Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="mb-3 px-4">
                <label class="label-control">Price</label>
                <input type="number" name="price" class="form-control">
            </div>

            <div class="mb-3 px-4">
                <label class="label-control">Select Category</label>
                <select id="category" name="category" class="form-control">
                    <option>Laptops</option>
                    <option>Desktops</option>
                    <option>Accessories</option>
                    <option>Components</option>
                </select>
            </div>

            <div class="mb-3 px-4">
                <label class="label-control">Stock</label>
                <input type="number" name="stock" class="form-control">
            </div>

            <div class="mb-3 px-4">
                <label class="label-control">Description</label>
                <textarea name="desc" id="desc" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-dark m-4">Add Product</button>

        </form>
    </div>
</section>

<section>
    <div class="productTable">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Descrition</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ asset($product->image) }}" width="80"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->category }}</td>

                    <td>
                        <div class="action-btns d-flex gap-2">

                            <a href="{{ route('admin.editProduct', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>

                           
                            <form action="{{ route('admin.deleteProduct', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection