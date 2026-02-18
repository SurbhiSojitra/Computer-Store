@extends('layout.app')

@section('title', 'Home')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
@endpush

@section('content')
<section>
    <div class="dashboard mt-5 mb-5">
        <h1>Admin Dashboard</h1>
    </div>
</section>

<section>
    <div class="container">
        <div class="dashboard-card">
            <div class="row mb-5">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-deatil">
                            <p class="products" style="font-size:2rem;"><i class="bi bi-box2-fill"></i></p>
                            <h4>Manage Products</h4>
                            <p>Add, edit, or remove products.</p>
                            <a href="{{route('admin.productList')}}" class="btn btn-info">Go To Products</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-deatil">
                            <p class="products" style="font-size:2rem;"><i class="bi bi-bag-fill"></i></p>
                            <h4>View Orders</h4>
                            <p>Check customer orders and status.</p>
                            <a href="{{route('admin.orders')}}" class="btn btn-info">Go To Orders</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection