@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
    <div class="container-fluid mt-5 pt-5">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="display-4">Gallery</h1>
                <p class="lead">A look at our team, projects, and memorable moments.</p>
            </div>
        </div>

        <div class="row g-4">
            @for ($i = 1; $i <= 9; $i++)
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card shadow-sm galery">
                        <img src="https://placehold.co/600x400/EEE/31343C" class="card-img-top" alt="Gallery Image {{ $i }}">
                        <div class="card-body">
                            <p class="card-text text-center">Caption for Image {{ $i }}</p>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection
