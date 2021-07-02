@extends('errors.errors_layout')
@section('title')
    404 -Page Not Found
@endsection
@section('errors_content')
    <!-- error area start -->
    <div class="error-area mt-5 text-center">
        <div class="container">
            <div class="error-content">
                <h2>404</h2>
                <p>Sorry! Page Not Found!</p>
                <hr>
                <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
                <a href="{{ route('admin.login') }}">Again Login</a>
            </div>
        </div>
    </div>
    <!-- error area end -->

@endsection
