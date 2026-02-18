@extends('layout.app')

@section('title', 'Home')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
@endpush

@section('content')
<section>
    <div class="container">
        <div class="orderTable">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'Unknown User' }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>${{ number_format($order->total_price, 2) }}</td>
                        <!-- <td>{{ ucfirst($order->status) }}</td> -->
                         <td>pending</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection