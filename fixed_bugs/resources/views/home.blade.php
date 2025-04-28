@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container-fluid mt-5 pt-5">
        <div class="row">
            <div class="col-12">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img height="600" src="https://plus.unsplash.com/premium_photo-1707229723342-1dc24b80ffd6?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZGVza3RvcCUyMHdhbGxwYXBlcnxlbnwwfHwwfHx8MA%3D%3D" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img height="600" src="https://plus.unsplash.com/premium_photo-1707229723342-1dc24b80ffd6?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZGVza3RvcCUyMHdhbGxwYXBlcnxlbnwwfHwwfHx8MA%3D%3D" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img height="600" src="https://plus.unsplash.com/premium_photo-1707229723342-1dc24b80ffd6?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZGVza3RvcCUyMHdhbGxwYXBlcnxlbnwwfHwwfHx8MA%3D%3D" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="title">Welcome to Our Website</h1>
                <p class="text text-center">This is the homepage of our site.</p>
            </div>
        </div>
    </div>


@endsection
