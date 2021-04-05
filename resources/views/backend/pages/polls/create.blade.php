@extends('backend.layouts.master')

@section('title')
    Polls Create page | Admin Dashboard
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
            <h1 class="m-0 text-dark">Poll Create</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ url('admin/polls/index') }}">All Poll</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>    <!-- /.content-header -->

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Create Poll</h3>
          <p class="float-right mb-2">
            <a class="btn btn-primary text-white" href="">All Poll</a>
        </p>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.polls.store') }}" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="title">Poll Title</label>
                        <input type="text" class="form-control" id="title" aria-describedby="titleHelp" name="title" placeholder="Enter Your Poll Title">
                        <small id="titleHelp" class="form-text text-muted">Give your Poll a title that attracts attention.</small>
                        @error('title')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="purpose">Poll Purpose</label>
                        <input type="text" class="form-control" id="purpose" name="purpose" aria-describedby="purposeHelp" placeholder="Enter Purpose">
                        <small id="purposeHelp" class="form-text text-muted">Give a purpose will increase response.</small>
                        @error('purpose')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                
                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Create Poll</button>
            </form>
        </div>

    </div><!-- /.card -->

</div><!-- /.content-wrapper -->

@endsection
@section('scripts')
@endsection