<nav class="navbar navbar-expand-lg bg-body-tertiary py-2">
    <div class="container-fluid">
        <a class="navbar-brand fs-3 fw-bold" href="#">Computer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav mx-auto gap-3 fs-5 text-center">
                <li class="nav-item">
                    <a class="nav-link active fw-bold" aria-current="page" href="{{route('admin.dashboard')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="{{route('admin.productList')}}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="{{route('admin.orders')}}">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="{{route('home')}}" target="_blank">View Site</a>
                </li>
            </ul>
            @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger rounded-4 px-4">Logout</button>
            </form>
            @endauth
        </div>
    </div>
    </div>
</nav>