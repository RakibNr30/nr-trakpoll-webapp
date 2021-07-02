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
              <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('user.polls.index') }}">All Survey</a></li>
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
                        <div class="card-header"><strong>{{ $key +1  }}. </strong>{{ $question->question }}
                            <span class="text-bold">
                                Total -
                                 {{ $question->responses->count() }}
                                Votes
                           </span>
                        </div>
                          <div class="card-body">

                            @error('responses.'.$key.'.answer_id')
                              <small class="text-danger">{{ $message }}</small>
                            @enderror


                            <ul class="list-group">
                                @foreach ($question->answers as $answer)
                                    <label for="answer{{ $answer->id }}">
                                      <li class="list-group-item">
                                        <input type="radio" name="responses[{{ $key }}][answer_id]" id="answer{{ $answer->id }}" class="mr-2" value="{{ $answer->id }}"
                                        <?php
                                        $info = App\Models\SurveyResponse::where('question_id',$question->id)
                                            ->where('user_id',Auth::guard('web')->user()->id)
                                            ->first();

                                            if($info){
                                                  if ($info->answer_id == $answer->id) {
                                                      echo "checked";
                                                  }
                                            }
                                        ?>
                                        >
                                        {{ $answer->answer }}
                                        @if($answer->responses->count() > 0)
                                            @php
                                                $per = intval(($answer->responses->count() * 100)/$question->responses->count())
                                            @endphp
                                            @if( $per>= 70)
                                                <span class="badge badge-success float-right">
                                                {{ $per }}%
                                            </span>
                                            @elseif ($per>= 40)
                                                <span class="badge badge-primary float-right">
                                                {{ $per }}%
                                            </span>
                                            @elseif ($per>= 20)
                                                <span class="badge badge-warning float-right">
                                                {{ $per }}%
                                            </span>
                                            @elseif ($per>= 1)
                                                <span class="badge badge-danger float-right">
                                                {{ $per }}%
                                            </span>
                                            @endif
                                        @endif

                                        <input type="hidden" name="responses[{{ $key }}][question_id]" value="{{ $question->id }}">
                                        <input type="hidden" name="responses[{{ $key }}][user_id]" value="{{ Auth::guard('web')->user()->id }}">
                                      </li>
                                    </label>
                                @endforeach
                            </ul>
                              <div class="row">
                                  <div class="col-12" id="accordion">
                                      <div class="card card-primary">
                                          <div class="card-header">
                                              <h4 class="card-title text-center w-100">
                                                  <a href="{{ route('front.poll.statistics', ['pid' => $poll->id,'qid' => $question->id]) }}">View Statistics</a>
                                              </h4>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                    @endforeach
              </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="hidden">
                 @php
                    $user_id = Auth::guard('web')->user()->id;
                    //$admin_id = Auth::guard('admin')->user()->id;
                    $user = App\Models\User::where('id', $user_id)->first();
                  @endphp
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="name" aria-describedby="nameHelp" name="survey[name]" value="{{$user->fname}} {{$user->lname}}">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="email" name="survey[email]" aria-describedby="emailHelp" value="{{$user->email}}">
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success">Complete Survey</button>
                </div>
            </div><!-- /.card -->
            </div>
          </div>
    </form>
  </div>
</div><!-- /.content-wrapper -->

@endsection
@section('scripts')
@endsection
