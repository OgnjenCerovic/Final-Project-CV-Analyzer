@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 mt-5">
                <h2 class="title">My Profile</h2>

                <table class="table table-dark table-hover table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Name</td>
                        <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <td>Last name</td>
                        <td>{{ Auth::user()->last_name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>{{ Auth::user()->status }}</td>
                    </tr>
                    @if (Auth::user()->resume)
                        <tr>
                            <td>Uploaded Resume</td>
                            <td><a href="{{ asset('storage/resumes/' . Auth::user()->resume) }}" target="_blank" class="link1">View Resume</a></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="{{ route('chat') }}" class="link1">chat</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="{{ route('suggest') }}" class="link1">job recomendations</a>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="2">
                            <a href="{{ route('logout') }}" class="link1">Logout</a>
                        </td>
                    </tr>
                    </tbody>
                </table>


            </div>

            <div class="col-12">
                <form action="{{ route('profile.uploadResume') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
                    @csrf
                    <label for="resume" class="me-2">Upload Resume</label>
                    <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx" class="form-control form-control-sm w-auto">
                    <button type="submit" class="btn btn-primary ms-2">Upload</button>
                </form>

                @if (Auth::user()->resume)


                    <form action="{{ route('profile.deleteResume') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-2">Delete Resume</button>
                    </form>

                    <!-- Form to trigger resume analysis -->
                    <form action="{{ route('profile.analyzeResume') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning mt-2">Analyze Resume</button>
                    </form>

                    <!-- Displaying the resume analysis if available -->
                    @if (session('resume_analysis'))
                        <h3>Resume Analysis</h3>
                        <p>{{ session('resume_analysis') }}</p>
                    @endif
                @endif
            </div>
        </div>
    </div>

@endsection
