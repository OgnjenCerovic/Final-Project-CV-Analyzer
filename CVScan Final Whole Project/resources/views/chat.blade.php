@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row mt-5">
        <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3 text-center mt-5">
            <div id="chat-container">
                <h2>Resume Analysis Chat</h2>
                <div id="chat-box"></div>

                <div class="d-flex">
                    <input type="text" id="chat-input" placeholder="Type a message..." class="form-control me-2" />
                    <button id="send-btn" class="btn btn-outline-success">Send</button>
                </div>
            </div>
        </div>
    </div>

@endsection
