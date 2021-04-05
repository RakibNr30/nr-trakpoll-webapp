@extends('backend.layouts.master')

@section('title')
    Admins Edit | Admin Dashboard
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
            <h1 class="m-0 text-dark">Admin Edit</h1>
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
          <h3 class="card-title">Edit Admin - {{ $admin->name }}</h3>
        </div>
        @include('backend.partials.message');
        <div class="card-body">
            <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="name">Admin Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}">
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="email">Admin Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="username">Admin Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $admin->username }}">
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="password">Assign Roles</label>
                        <select name="roles[]" id="roles" class="form-control select2" multiple>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ $admin->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Admin</button>
            </form>
        </div>

    </div><!-- /.card -->

</div><!-- /.content-wrapper -->

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>
@endsection