@extends('backend.layouts.master')

@section('title')
    Users Edit | Admin Dashboard
@endsection
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
@endsection

@section('admin_content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Socialite</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Socialite</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>    <!-- /.content-header -->

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Socialite</h3>
            </div>
            @include('backend.partials.message')
            <div class="card-body">
                <form action="{{ route('admin.socialite.update', ['id' => $socialite->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="google_client_id">Google Client Id</label>
                            <input type="text" class="form-control" id="google_client_id" name="google_client_id" value="{{ $socialite->google_client_id  }}" placeholder="Enter google client id">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="google_client_secret">Google Client Secret</label>
                            <input type="text" class="form-control" id="google_client_secret" name="google_client_secret" value="{{ $socialite->google_client_secret }}" placeholder="Enter google client secret">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="facebook_client_id">Facebook Client Id</label>
                            <input type="text" class="form-control" id="facebook_client_id" name="facebook_client_id" value="{{ $socialite->facebook_client_id  }}" placeholder="Enter facebook client id">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="facebook_client_secret">Facebook Client Secret</label>
                            <input type="text" class="form-control" id="facebook_client_secret" name="facebook_client_secret" value="{{ $socialite->facebook_client_secret }}" placeholder="Enter facebook client secret">
                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                            <label for="app_secret_key">App Secret Key</label>
                            <input type="text" class="form-control" id="app_secret_key" name="app_secret_key" value="{{ $socialite->app_secret_key }}" placeholder="Enter app secret key" required>
                            @error('app_secret_key')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Socialite</button>
                </form>
            </div>

        </div><!-- /.card -->

    </div><!-- /.content-wrapper -->

@endsection
@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        })
    </script>
@endsection