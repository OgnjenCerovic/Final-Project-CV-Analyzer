@extends('layouts.app')

@section('title', 'Login')

@section('content')

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2 col-lg-4 offset-lg-4">
                <h2>Login</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" placeholder="Email" required class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" placeholder="Password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>


                    <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
                </form>
            </div>
        </div>
    </div>
@endsection
