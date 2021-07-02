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
            <h1 class="m-0 text-dark">Showing All Created Survey</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ url('admin/polls/index') }}">All Survey</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>    <!-- /.content-header -->

    <div class="card">
        <div class="card-header">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Showing Survey By Date Wise</h2>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>Searching Result {{ $search_from }} to {{ $search_to }}</h2>
                        </div>
                    </div>
              </div>
            </div>
        </div>
        <div class="card-body">
            @foreach ($search_polls as $search_poll)
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="card mt-3">
                            <div class="card-body mt-2">
                            <a href="{{ $search_poll->path() }}" style="" class="text-success">{{ $search_poll->title }}</a>

                            <a href="{{ url('admin/polls/'.$search_poll->id.'/edit') }}" class="float-right" style="margin-right:20px"><i class="fas fa-edit" style="color:black"></i></a>
                              @if(Auth::guard('admin')->user()->can('poll.approved'))
                                  @if($search_poll->status == 1)
                                  <a href="{{Route('admin.poll.approved',$search_poll->id)}}" style="margin-right:20px" class="float-right"><span class="text-success">Approved</span>
                                  </a>
                                  @else
                                  <a href="{{Route('admin.poll.disapproved',$search_poll->id)}}" style="margin-right:20px" class="float-right"><span class="text-danger">Disapproved</span>
                                  </a>
                                  @endif
                              @endif

                              <a class="float-right" href="#duplicate-form{{ $search_poll->id }}" data-toggle="modal" style="margin-right:20px; color:rgb(29, 145, 212)">
                                <i class="fas fa-plus"></i>
                              </a>
                              <!--Duplicate Modal -->
                              <div id="duplicate-form{{ $search_poll->id }}" class="modal fade">
                                <div class="modal-dialog modal-confirm">
                                    <div class="modal-content">
                                        <div class="modal-header flex-column">
                                            <div class="icon-box text-success">
                                                <i class="material-icons">&#x2714;</i>
                                            </div>
                                            <h4 class="modal-title w-100">Are you sure?</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you really want to delete these records? This process cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <form action="#" method="POST">
                                              @csrf
                                              <button type="submit" class="btn btn-danger">Duplicate</button>
                                          </form>
                                        </div>
                                    </div>
                                </div>
                              </div>
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
