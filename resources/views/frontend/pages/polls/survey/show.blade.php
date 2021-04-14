@extends('frontend.pages.layouts.master')

@section('title')
    Survey page | User Dashboard
@endsection
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
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
            <h4 class="m-0 text-dark">{{ $poll->title }}</h4>
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
    <form action="{{ route('user.polls.survey.store',$poll->id) }}" method="POST">
      @csrf
          <div class="card">
              <div class="card-body">
                    @foreach ($poll->questions as $key => $question)
                      <div class="card">
                        <div class="card-header"><strong>{{ $key +1  }}. </strong>{{ $question->question }}</div>
                          <div class="card-body">

                            @error('responses.'.$key.'.answer_id')
                              <small class="text-danger">{{ $message }}</small>
                            @enderror


                            <ul class="list-group">
                                @foreach ($question->answers as $answer)
                                    <label for="answer{{ $answer->id }}">
                                      <li class="list-group-item">
                                        <input type="radio" name="responses[{{ $key }}][answer_id]" id="answer{{ $answer->id }}" {{ (old('responses.'.$key.'.answer_id') == $answer->id )? 'checked': '' }} class="mr-2" value="{{ $answer->id }}">
                                        {{ $answer->answer }}

                                        <input type="hidden" name="responses[{{ $key }}][question_id]" value="{{ $question->id }}">
                                        <input type="hidden" name="responses[{{ $key }}][user_id]" value="{{ Auth::guard('web')->user()->id }}">
                                      </li>
                                    </label>
                                @endforeach
                            </ul>
                          </div>
                    </div>
                    @endforeach
              </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="card">
                <div class="card-header">
                  <h2 class="card-title">Your Information</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="survey[name]" placeholder="Enter Your Name">
                        <small id="nameHelp" class="form-text text-muted">Hello! What's your name?</small>
                        @error('name')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="survey[email]" aria-describedby="emailHelp" placeholder="Enter your Email">
                        <small id="emailHelp" class="form-text text-muted">Your Email Please!</small>
                        @error('email')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                      <button type="submit" class="btn btn-success">Complete Survey</button>
                    </div>
                </div>
            </div><!-- /.card -->
            </div>
          </div>
    </form>

    @include('frontend.pages.polls.survey.comment')

  </div>
</div><!-- /.content-wrapper -->

@endsection
@section('scripts')
@endsection
