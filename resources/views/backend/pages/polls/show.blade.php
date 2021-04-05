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
            <h1 class="m-0 text-dark">Poll</h1>
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
          <h2 class="card-title">{{ $poll->title }}</h2>
          <p class="float-right mb-2">
            <a class="btn btn-primary text-white" href="{{ url('admin/polls/'.$poll->id.'/questions/create') }}">Add New Question</a>
            <a class="btn btn-dark text-white" href="{{ url('admin/surveys/'.$poll->id.'-'.Str::slug($poll->title)) }}">Take Survey</a>
        </p>
        {{-- @include('backend.partials.message'); --}}
        </div>
        <div class="card-body">
            @foreach ($poll->questions as $question)
              <div class="card">             
                  <div class="card-header">{{ $question->question }}
                    <span class="text-bold">
                     Total -
                      {{ $question->responses->count() }}
                     Votes
                      </span>
                    
                    <a href="{{ url('admin/polls/'.$poll->id.'/questions/'.$question->id.'/edit') }}" class="float-right" style="margin-right:20px"><i class="fas fa-edit" style="color:black"></i></a>
                  </div>
                    <div class="card-body">
                      <ul class="list-group">
                          @foreach ($question->answers as $answer)
                              <li class="list-group-item">
                                  <p class="float-left">{{ $answer->answer }}</p>
                                    @if($answer->responses->count() > 0)
                                        <span class="badge badge-success float-right">
                                            {{ intval(($answer->responses->count() * 100)/$question->responses->count()) }}%
                                        </span>
                                    @endif
                                    
                              </li>
                          @endforeach
                      </ul>
                    </div>
                    <div class="card-footer">
                      <a class="btn btn-sm btn-outline-danger" href="#delete-form{{ $poll->id }}" data-toggle="modal">Delete Question</a>

                      {{-- <form action="{{ url('admin/polls/'.$poll->id.'/questions/'.$question->id) }}" method="POST">
                         @method('DELETE')
                         @csrf
    
                         <button class="btn btn-sm btn-outline-danger" href="#delete-form{{ $admin->id }}" data-toggle="modal">Delete Question</button>
                      </form> --}}

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
                  </div>
                </div>
              @endforeach
          </div>
     </div><!-- /.card -->

</div><!-- /.content-wrapper -->

@endsection
@section('scripts')
@endsection