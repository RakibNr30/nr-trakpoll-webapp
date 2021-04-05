@extends('frontend.pages.layouts.master')

@section('title')
Polls index page | User Dashboard
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

@section('user_content')
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
              <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('user.polls.index') }}">All Poll</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>    <!-- /.content-header -->

    <div class="card">
        <div class="card-body">
            @foreach ($polls as $poll)
                <ul class="list-group">
                    @if($poll->status == 1)
                    <li class="list-group-item">
                        <div class="card mt-3">
                            <div class="card-body mt-2">
                              <a href="{{ $poll->path() }}" style="" class="text-success">{{ $poll->title }}</a>
                            </div>
                            <div class="card-footer">
                              <small class="font-weight-bold">Share URL</small>
                              <p>
                                  <a href="{{ $poll->publicpath() }}" target="_blank" style="text-decoration: none; background-color: transparent;" class="text-dark">
                                      {{ $poll->publicpath() }}
                                  </a>
                              </p>
                          </div>
                        </div>
                    </li>
                    @endif
                </ul>
            @endforeach
        </div>
     </div><!-- /.card -->

</div><!-- /.content-wrapper -->

@endsection
@section('scripts')
@endsection