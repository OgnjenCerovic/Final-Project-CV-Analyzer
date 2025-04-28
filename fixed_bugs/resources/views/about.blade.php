@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <div class="container-fluid mt-5 pt-5  text-center">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="display-4">About Us</h1>
                <p class="lead">Learn more about our mission, values, and the team behind the project.</p>
            </div>
        </div>

        <!-- Who We Are Section -->
        <div class="row mb-5 align-items-center">
            <div class="col-md-6 text-center">
                <img src="https://placehold.co/600x400/EEE/31343C" class="img-fluid rounded" alt="Our Office">
            </div>
            <div class="col-md-6">
                <h2>Who We Are</h2>
                <p>We are a team of passionate individuals committed to building high-quality web applications and tools that make people's lives easier. Our diverse backgrounds and unified goal make us stronger every day.</p>
            </div>
        </div>

        <!-- Our Mission Section -->
        <div class="row mb-5 align-items-center flex-md-row-reverse">
            <div class="col-md-6">
                <img src="https://placehold.co/600x400/EEE/31343C" class="img-fluid rounded" alt="Mission Image">
            </div>
            <div class="col-md-6">
                <h2>Our Mission</h2>
                <p>Our mission is to create digital solutions that are user-friendly, accessible, and impactful. We strive to provide tools that empower both individuals and businesses through innovation and dedication.</p>
            </div>
        </div>

        <!-- Meet the Team -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2>Meet the Team</h2>
            </div>

            <div class="col-md-4 text-center mb-4">
                <img src="https://placehold.co/600x400/EEE/31343C" class="rounded-circle mb-3" alt="Team Member 1">
                <h5>Jane Doe</h5>
                <p>Lead Developer</p>
            </div>

            <div class="col-md-4 text-center mb-4">
                <img src="https://placehold.co/600x400/EEE/31343C" class="rounded-circle mb-3" alt="Team Member 2">
                <h5>John Smith</h5>
                <p>UI/UX Designer</p>
            </div>

            <div class="col-md-4 text-center mb-4">
                <img src="https://placehold.co/600x400/EEE/31343C" class="rounded-circle mb-3" alt="Team Member 3">
                <h5>Emily Clark</h5>
                <p>Project Manager</p>
            </div>
        </div>
    </div>
@endsection
