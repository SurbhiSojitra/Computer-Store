@extends('layout.app')

@section('title', 'Home')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
@endpush

@section('content')
<section>
    <div class="container">
        <div class="loginPage mt-5 mb-5">
            <div class="card p-3">
                <div class="login-heading p-4">
                    <h2>Create Account</h2>
                </div>

                <div class="card-body">
                    <form action="{{ route('registered') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="label-control m-2">Full Name</label>
                            <input type="text" name="name" placeholder="Enter Your Name" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="label-control m-2">Email Address</label>
                            <input type="email" name="email" placeholder="Enter Your Email" class="form-control">
                        </div>


                        <div class="mb-4">
                            <label for="password" class="label-control m-2">Password</label>
                            <input type="password" name="password" placeholder="Enter Your Password" class="form-control">
                        </div>

                        <div class="mb-4">
                            <label for="confirmPassword" class="label-control m-2">Confirm Password</label>
                            <input type="confirmPassword" name="confirmPassword" placeholder="Confirm Password" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-success mb-4 w-100">Register</button>
                        <div class="register d-flex justify-content-center align-items-center">
                            <p>Don't have an account? <a href="{{route('login')}}"> Login here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection