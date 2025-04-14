@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>My Profile</h2>

                <p><strong>Name:</strong> {{ Auth::user()->name }} {{ Auth::user()->last_name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Status:</strong> {{ Auth::user()->status }}</p>

                <a href="{{ route('logout') }}">Logout</a>
            </div>

            <div class="col-12">
                <form action="{{ route('profile.uploadResume') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="resume">Upload Resume</label>
                        <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>

                @if (Auth::user()->resume)
                    <h3>Uploaded Resume</h3>
                    <a href="{{ asset('storage/resumes/' . Auth::user()->resume) }}" target="_blank">View Resume</a>

                    <form action="{{ route('profile.deleteResume') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Resume</button>
                    </form>
                @endif
            </div>
        </div>
    </div>


@endsection
