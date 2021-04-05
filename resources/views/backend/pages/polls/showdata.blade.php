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
                <div class="col-md-6">
                  <form action="{{ Route('poll.search') }}" method="GET">
                    <div class="input-group mb-3">
                      <input type="date" class="form-control" placeholder="Search" name="search" aria-describedby="searchHelp">
                      <div class="input-group-append">
                        <button class="btn btn-success" type="submit">Search</button>
                      </div>
                    </div>
                    @error('search')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </form>
                </div>
              </div>
            </div>
        </div>
        <div class="card-body">
            @foreach ($polls as $poll)
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="card mt-3">
                            <div class="card-body mt-2">
                              <a href="{{ $poll->path() }}" style="" class="text-success">{{ $poll->title }}</a>

                              <a href="{{ url('admin/polls/'.$poll->id.'/edit') }}" class="float-right" style="margin-right:20px"><i class="fas fa-edit" style="color:black"></i></a>

                              @if($poll->status == 1)
                              <a href="{{Route('admin.poll.approved',$poll->id)}}" style="margin-right:20px" class="float-right"><span class="text-success">Approved</span>
                              </a>
                              @else
                              <a href="{{Route('admin.poll.disapproved',$poll->id)}}" style="margin-right:20px" class="float-right"><span class="text-danger">Disapproved</span>
                              </a>
                              {{-- @if($product->status == 1)
                              <a class="btn btn-dark" href="{{Route('admin.product.deactiveproduct',$product->id)}}">
                                  <i class="fas fa-thumbs-down"></i>
                              </a>
                              @else
                              <a class="btn btn-success" href="{{Route('admin.product.activeproduct',$product->id)}}">
                                  <i class="fas fa-thumbs-up"></i>
                              </a> --}}
                              @endif



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
                </ul>
            @endforeach
        </div>
     </div><!-- /.card -->

</div><!-- /.content-wrapper -->

@endsection
@section('scripts')
@endsection