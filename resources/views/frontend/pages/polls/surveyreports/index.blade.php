@extends('frontend.pages.layouts.master')

@section('title')
    Survey Result | User Dashboard
@endsection
@section('style')
<style>

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
            <h1 class="m-0 text-dark">Survey Result</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('user.polls.index') }}">All Survey</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Survey Result</h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="10%">Sl</th>
                <th width="40%">Question</th>
                <th width="30%">Answer</th>
                <th width="20%">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($responses as $key => $response)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>
                        @php
                            $questions = \App\Models\Question::where('id', $response->question_id)->get();
                        @endphp
                        @foreach ($questions as $question)
                            {{ $question->question }}
                        @endforeach
                    </td>
                    <td>
                    @php
                        $answers = \App\Models\Answer::where('id', $response->answer_id)->get();
                    @endphp
                    @foreach ($answers as $answer)
                        {{ $answer->answer }}
                    @endforeach
                    </td>

                    <td><a href="{{ route('user.polls.survey', $question->poll_id) }}" class="btn btn-info btn-sm">View Survey</a></td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th width="10%">Sl</th>
              <th width="40%">Question</th>
              <th width="30%">Answer</th>
              <th width="20%">Action</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
    </div><!-- /.card -->

</div><!-- /.content-wrapper -->

@endsection
