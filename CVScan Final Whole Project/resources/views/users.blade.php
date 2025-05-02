@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="min-vh-100 d-flex justify-content-center align-items-center">
                    @if($employees->isEmpty())
                        <p>No employees found.</p>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Resume</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $employee->name }} {{ $employee->last_name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>
                                        @if($employee->resume)
                                            <a href="/storage/app/public/resumes/{{$employee->resume }}" target="_blank">View Resume</a>
                                        @else
                                            No resume uploaded
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
