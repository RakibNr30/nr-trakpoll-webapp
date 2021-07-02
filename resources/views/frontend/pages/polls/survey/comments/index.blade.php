@extends('frontend.pages.layouts.master')


@section('title')
   All Comments | User Dashboard
@endsection

@section('user_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Comments</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.admins.index') }}">Comments List</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Comments List</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="5%">Sl</th>
                <th width="10%">User</th>
                <th width="20%">Comment</th>
                <th width="20%">Poll</th>
                <th width="10%">Created</th>
                <th width="15%">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ Auth::guard('web')->user()->fname }}</td>
                    <td>{{ $comment->comment }}</td>
                    <td>{{ $comment->poll->title }}</td>
                    <td>{{ $comment->created_at->diffForHumans() }}</td>

                    <td style="text-align:center;">
                        <?php
                            $info = App\Models\Question::where('poll_id',$comment->poll_id)
                                            ->first();
                        ?>
                        <a href="{{ route('user.polls.survey', $info->poll_id) }}" class="btn btn-info btn-sm">View Comment</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th width="5%">Sl</th>
              <th width="10%">User</th>
              <th width="20%">Comment</th>
              <th width="20%">Poll</th>
              <th width="10%">Created</th>
              <th width="15%">Action</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
    </div><!-- /.card -->

</div><!-- /.content-wrapper -->

@endsection
