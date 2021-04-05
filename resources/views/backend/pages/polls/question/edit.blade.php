@extends('backend.layouts.master')

@section('title')
Polls Question Edit page | Admin Dashboard
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
            <h1 class="m-0 text-dark">Poll Question Edit</h1>
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
          <h3 class="card-title">Question Edit</h3>
          <p class="float-right mb-2">
            <a class="btn btn-primary text-white" href="">All Poll</a>
        </p>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/polls/'.$poll->id.'/questions/'.$question->id.'/update') }}" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" class="form-control" id="question" aria-describedby="questionHelp" name="question" value="{{ $question->question }}">
                        <small id="questionHelp" class="form-text text-muted">Ask Simple and to the point question for best result.</small>
                        @error('question.question')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <fieldset>
                            <legend>Choices</legend>
                            <small id="choicesHelp" class="form-text text-muted">Give choices that give you the best insight into your question.</small>
                            <div>
                                 @foreach ($question->answers as $key => $answer)
                                <div class="form-group">
                                    <label for="answer1">Choice {{ $key+1 }}</label>
                                    <input type="hidden" name="answer_id[]" value="{{ $answer->id }}"/>
                                    <input type="text" class="form-control" id="answer1" name="answer[]" aria-describedby="choicesHelp" value="{{ $answer->answer }}">

                                    @error('answers.0.answer')
                                      <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    @endforeach
                                </div>
                            </div>
                        </fieldset>
                    </div>
                
                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Question</button>
            </form>
        </div>

    </div><!-- /.card -->

</div><!-- /.content-wrapper -->

@endsection
@section('scripts')
@endsection