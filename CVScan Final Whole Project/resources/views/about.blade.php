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
                <img src="https://solutionsandco.com/images/easyblog_articles/844/b2ap3_large_shutterstock_633468920.jpg" class="img-fluid rounded" alt="Our Office">
            </div>
            <div class="col-md-6">
                <h2>Who Are We</h2>
                <p>We are a team of passionate individuals committed to building high-quality web applications and tools that make people's lives easier. Our diverse backgrounds and unified goal make us stronger every day.</p>
            </div>
        </div>

        <!-- Our Mission Section -->
        <div class="row mb-5 align-items-center flex-md-row-reverse">
            <div class="col-md-6">
                <img src="https://media.licdn.com/dms/image/v2/D4E12AQHgMxo-g7BYsw/article-cover_image-shrink_720_1280/article-cover_image-shrink_720_1280/0/1658422953944?e=2147483647&v=beta&t=Z2tA86SPCvcG9ieACH8jr4SSL47dclFPchqYJIPI4gY" class="img-fluid rounded" alt="Mission Image">
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
                <img src="https://retratosbarcelona.com/wp-content/uploads/2022/09/Retratos-Barcelona-Linkedin-Photography-Alejandra.jpg" class="rounded-circle mb-3" alt="Team Member 1" width="600" height="400">
                <h5>Jane Doe</h5>
                <p>Lead Developer</p>
            </div>

            <div class="col-md-4 text-center mb-4">
                <img src="https://nickcolephotography.co.uk/wp-content/uploads/2020/08/Rhys-HS-31-Edit-2-1024x683.jpg" width="600" height="400" class="rounded-circle mb-3" alt="Team Member 2">
                <h5>John Smith</h5>
                <p>UI/UX Designer</p>
            </div>

            <div class="col-md-4 text-center mb-4">
                <img src="https://images.squarespace-cdn.com/content/v1/5cf0d08d5fc69d000172462a/1632213066510-Y4M7JJYPMEJLP1DI4HC2/Andrine+Business+Headshot+London.jpg" class="rounded-circle mb-3" alt="Team Member 3" width="600" height="400">
                <h5>Emily Clark</h5>
                <p>Project Manager</p>
            </div>
        </div>
    </div>
@endsection
