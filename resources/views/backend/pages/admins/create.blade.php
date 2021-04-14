@extends('backend.layouts.master')

@section('title')
    Admins Create | Admin Dashboard
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
            <h1 class="m-0 text-dark">Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.admins.index') }}">All Admin</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>    <!-- /.content-header -->

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Create Admin</h3>
          <p class="float-right mb-2">
            <a class="btn btn-primary text-white" href="{{ route('admin.admins.create') }}">Create New Admin</a>
        </p>
        </div>
        @include('backend.partials.message');
        <div class="card-body">
            <form action="{{ route('admin.admins.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="name">Admin Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name">
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="email">Admin Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password">
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Your Password">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="username">Admin Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Your Username" required>
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="password">Assign Roles</label>
                        <select name="roles[]" id="roles" class="form-control select2" multiple>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Admin</button>
            </form>
        </div>

    </div><!-- /.card -->

</div><!-- /.content-wrapper -->

@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <style>
        .select2-container--default .select2-selection--multiple {
            padding-bottom: 0;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;
            border: 1px solid #000;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #000;
        }
    </style>
@stop
@section('script')
    <script src="{{ asset('backend/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        })
    </script>
@stop