@extends('backend.layouts.master')

@section('title')
    Polls Question page | Admin Dashboard
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
                        <h1 class="m-0 text-dark">Poll Question Create</h1>
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
                <h3 class="card-title">Create New Question</h3>
                <p class="float-right mb-2">
                    <a class="btn btn-primary text-white" href="">All Poll</a>
                </p>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/polls/'.$poll->id.'/question') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" class="form-control" id="question" aria-describedby="questionHelp" name="question" value="{{ old('question') }}" placeholder="Enter Your Question">
                        <small id="questionHelp" class="form-text text-muted">Ask Simple and to the point question for best result.</small>
                        @error('question')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="countries">Enter Country/ Countries</label>
                        <select name="country_ids[]" id="country" class="form-control select2" aria-describedby="countriesHelp" multiple required>
                            <option value="">Select Country</option>
                            @foreach ($Getcountrylist as $Country)
                                <option value="{{$Country->id}}">{{$Country->name}}</option>
                            @endforeach
                        </select>
                        <small id="countriesHelp" class="form-text text-muted">Select a country to get best result for your Survey</small>
                    </div>
                    <div class="form-group">
                        <fieldset>
                            <legend>Choices</legend>
                            <small id="choicesHelp" class="form-text text-muted">Give choices that give you the best insight into your question.</small>
                            <div>
                                <div class="form-group">
                                    <label for="answer1">Choice 1</label>
                                    <input type="text" class="form-control" id="answer1" name="answers[][answer]" aria-describedby="choicesHelp" value="{{ old('answers.0.answer') }}" placeholder="Enter choice 1">

                                    @error('answers.0.answer')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    <label for="answer2">Choice 2</label>
                                    <input type="text" class="form-control" id="answer2" name="answers[][answer]" aria-describedby="choicesHelp" value="{{ old('answers.1.answer') }}" placeholder="Enter choice 2">

                                    @error('answers.1.answer')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    <label for="answer3">Choice 3</label>
                                    <input type="text" class="form-control" id="answer3" name="answers[][answer]" aria-describedby="choicesHelp" value="{{ old('answers.2.answer') }}" placeholder="Enter choice 3">

                                    @error('answers.2.answer')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    <label for="answer4">Choice 4</label>
                                    <input type="text" class="form-control" id="answer4" name="answers[][answer]" aria-describedby="choicesHelp" value="{{ old('answers.3.answer') }}" placeholder="Enter choice 4">

                                    @error('answers.3.answer')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Add Question</button>
                </form>
            </div>

        </div><!-- /.card -->

    </div><!-- /.content-wrapper -->

@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <style>
        .select2-container--default .select2-selection--multiple {
            padding-bottom: 0;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;
            border: 1px solid #000;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #000;
        }
    </style>
@stop
@section('script')
    <script src="{{ asset('backend/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        })
    </script>
@stop
