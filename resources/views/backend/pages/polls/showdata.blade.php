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
                        <div class="col-md-12">
                            <form action="{{ Route('poll.search') }}" method="GET">
                                <div class="input-group mb-3">
                                    <div class="col-md-6">
                                        <label>From Date</label>
                                        <input type="date" class="form-control" placeholder="Search" name="searchfrom" aria-describedby="searchHelp">
                                    </div>
                                    <div class="col-md-6">
                                        <label>To Date</label>
                                        <input type="date" class="form-control" placeholder="Search" name="searchto" aria-describedby="searchHelp"><br/>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" type="submit">Search</button>
                                        </div>
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

                                    <a href="{{ url('admin/polls/'.$poll->id.'/edit') }}" class="btn btn-default btn-xs float-right" style="margin-right:20px">
                                        <span class="badge badge-secondary"><i class="fas fa-edit"></i></span> Edit
                                    </a>
                                    @if(Auth::guard('admin')->user()->can('poll.approved'))
                                        @if($poll->status == 1)
                                            <a href="{{Route('admin.poll.approved',$poll->id)}}" style="margin-right:20px" class="btn btn-default btn-xs float-right">
                                                <span class="badge badge-success"><i class="fas fa-check"></i></span> Approved
                                            </a>
                                        @else
                                            <a href="{{Route('admin.poll.disapproved',$poll->id)}}" style="margin-right:20px" class="btn btn-default btn-xs float-right">
                                                <span class="badge badge-danger"><i class="fas fa-thumbs-down"></i></span> Disapproved
                                            </a>
                                        @endif
                                    @endif

                                    <a class="btn btn-default btn-xs float-right" href="#duplicate-form{{ $poll->id }}" data-toggle="modal" style="margin-right:20px;">
                                        <span class="badge badge-info"><i class="fas fa-plus"></i></span> Duplicate
                                    </a>
                                    <!--Duplicate Modalc -->
                                    <div id="duplicate-form{{ $poll->id }}" class="modal fade">
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
                                                    <form action="{{ route('admin.polls.duplicate',$poll->id) }}" method="POST">
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
