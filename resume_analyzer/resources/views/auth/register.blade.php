@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2 col-lg-4 offset-lg-4">
            <h2>Register</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" name="name" placeholder="First Name" required class="form-control">
                </div>
                <div class="mb-3">
                    <input type="text" name="last_name" placeholder="Last Name" required class="form-control">
                </div>
                <div class="mb-3">
                    <input type="email" name="email" placeholder="Email" required class="form-control">
                </div>
                <div class="mb-3">
                    <select name="status" class="form-control form-select">
                        <option value="employer">Employer</option>
                        <option value="employee">Employee</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" placeholder="Password" required class="form-control">
                </div>
                <div class="mb-3">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Register</button>

                <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
            </form>

        </div>
    </div>
</div>
@endsection
