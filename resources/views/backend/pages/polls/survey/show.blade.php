@extends('backend.layouts.master')

@section('title')
    Survey page | Admin Dashboard
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
            <h4 class="m-0 text-dark">{{ $poll->title }}</h4>
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
    <form action="{{ url('admin/surveys/'.$poll->id.'-'.Str::slug($poll->title)) }}" method="POST">
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
                <div class="hidden">
                  @php
                    //$user_id = Auth::guard('web')->user()->id;
                    $admin_id = Auth::guard('admin')->user()->id;
                    $user = App\Models\Admin::where('id', $admin_id)->first();
                  @endphp

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="name" aria-describedby="nameHelp" name="survey[name]" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="email" name="survey[email]" aria-describedby="emailHelp" value="{{$user->email}}">
                        </div>
                </div><!-- /.card -->
                <div>
                  <button type="submit" class="btn btn-success">Complete Survey</button>
                </div>
            </div>
          </div>
    </form>

    @include('backend.pages.polls.survey.comment')

  </div>
</div><!-- /.content-wrapper -->

@endsection
@section('scripts')
@endsection
