@extends('backend.layouts.master')

@section('title')
    Question | Admin Dashboard
@endsection
@section('style')
<style>

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
            <h1 class="m-0 text-dark">Question</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">Question List</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Question List</h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="5%">Sl</th>
                <th width="30%">Question</th>
                <th width="30%">Poll</th>
                {{-- <th width="15%">Action</th> --}}
            </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $question->question }}</td>
                    <td>
                        @foreach ($question->answers as $answer)
                        <ul>
                            <li>{{ $answer->answer }}</li>
                        </ul>

                        @endforeach
                    </td>
                    {{-- <td style="text-align:center;">
                        @if(Auth::guard('admin')->user()->can('poll.delete'))
                                <a class="btn btn-default btn-xs float-right" href="#delete-form{{ $poll->id }}" data-toggle="modal"><span class="badge badge-danger"><i class="fas fa-trash"></i></span> Delete</a>

                                <div id="delete-form{{ $poll->id }}" class="modal fade">
                                    <div class="modal-dialog modal-confirm">
                                        <div class="modal-content">
                                            <div class="modal-header flex-column">
                                                <div class="icon-box">
                                                    <i class="material-icons">&#xE5CD;</i>
                                                </div>
                                                <h4 class="modal-title w-100">Are you sure?</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Do you really want to delete these records? This process cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ url('admin/polls/'.$poll->id.'/questions/'.$question->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <a href="{{ url('admin/polls/'.$poll->id.'/questions/'.$question->id.'/edit') }}" class="btn btn-default btn-xs float-right" style="margin-right:20px"><span class="badge badge-warning"><i class="fas fa-edit"></i></span> Edit</a>

                    </td> --}}
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th width="5%">Sl</th>
                <th width="30%">Question</th>
                <th width="30%">Poll</th>
                {{-- <th width="15%">Action</th> --}}
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
    </div><!-- /.card -->

</div><!-- /.content-wrapper -->

@endsection
