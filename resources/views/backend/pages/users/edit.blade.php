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
            <h1 class="m-0 text-dark">User Edit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">All User</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>    <!-- /.content-header -->

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit User - {{ $users->name }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $users->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" value="{{ $users->fname }}">
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" value="{{ $users->lname }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="email">User Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $users->email }}">
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


                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update User</button>
            </form>
        </div>

    </div><!-- /.card -->

</div><!-- /.content-wrapper -->

@endsection

