@extends('errors.errors_layout')
@section('title')
    403 -Access Deinied
@endsection
@section('errors_content')
    <!-- error area start -->
    <div class="error-area mt-5 text-center">
        <div class="container">
            <div class="error-content">
                <h2>403</h2>
                <p>Access to this resource on the server is denied</p>
                <hr>
                <h6>{{ $exception->getMessage() }}</h6>
                <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
                <a href="{{ route('admin.login') }}">Again Login</a>
            </div>
        </div>
    </div>
    <!-- error area end -->
        
@endsection