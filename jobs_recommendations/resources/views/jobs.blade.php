@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="h5">Job Recommendations</h1>

            @if(count($jobs) > 0)
                @foreach($jobs as $job)
                    <div class="bg-secondary p-3 text-white mt-5">
                        <h1>{{ $job['job_title'] }}</h1>
                        <a target="_blank" href="{{ $job['employer_website'] }}"><b>{{ $job['employer_name'] }}</b></a><br>
                        <small>{{ $job['job_employment_type'] }}</small><br>
                        <a target="_blank" href="{{ $job['job_apply_link'] }}">apply</a><br>
                        <p>
                            {!! nl2br(e($job['job_description'])) !!}
                        </p>
                        <p><b>{{ $job['job_location'] }},{{ $job['job_city'] }},{{ $job['job_state'] }},{{ $job['job_country'] }}</b></p>
                        <p>{{ $job['job_min_salary'] }} - {{ $job['job_max_salary'] }} {{ $job['job_salary_period'] }}</p>
                    </div>
                @endforeach
            @else
                <p>No jobs found matching your resume.</p>
            @endif
            <hr>
        </div>
    </div>
@endsection
