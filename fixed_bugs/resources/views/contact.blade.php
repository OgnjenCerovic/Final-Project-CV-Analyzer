@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container-fluid mt-5 pt-5">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name *</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject *</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message *</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>


@endsection
