@extends('backend.layouts.master')

@section('title')
Polls index page | Admin Dashboard
@endsection
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }
    .card-body mt-2 a{
      text-decoration: none; 
      background-color: transparent;
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
            <h1 class="m-0 text-dark">Showing All Created Poll</h1>
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
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Showing Poll By Date Wise</h2>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2> {{ $poll_search }} Searching Result.....</h2>
                        </div>
                    </div>
              </div>
            </div>
        </div>
        <div class="card-body">
            @foreach($search_polls as $search_poll)
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="card mt-3">
                            <div class="card-body mt-2">
                            <a href="{{ $search_poll->path() }}" style="" class="text-success">{{ $search_poll->title }}</a>

                            <a href="{{ url('admin/polls/'.$search_poll->id.'/edit') }}" class="float-right" style="margin-right:20px"><i class="fas fa-edit" style="color:black"></i></a>
                            <a href="" style="margin-right:20px" class="float-right"><i class="fas fa-thumbs-up" style="color:green"></i></a>
                            </div>
                            <div class="card-footer">
                            <small class="font-weight-bold">Share URL</small>
                            <p>
                                <a href="{{ $search_poll->publicpath() }}" target="_blank" style="text-decoration: none; background-color: transparent;" class="text-dark">
                                    {{ $search_poll->publicpath() }}
                                </a>
                            </p>
                        </div>
                        </div>
                    </li>
                </ul>
            @endforeach
        </div>
     </div><!-- /.card -->

</div><!-- /.content-wrapper -->

@endsection
@section('scripts')
@endsection