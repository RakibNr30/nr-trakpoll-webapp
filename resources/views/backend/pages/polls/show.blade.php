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
                        <h1 class="m-0 text-dark">Survey</h1>
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
                <h2 class="card-title">{{ $poll->title }}</h2>
                <p class="float-right mb-2">
                    <?php
                        $poll_id = App\Models\Question::where('poll_id',$poll->id)->get();
                        if(count($poll_id) > 0){
                    ?>
                            <strong>Question Already Created!</strong>
                    <?php
                        }
                        else{
                    ?>
                            <a class="btn btn-primary text-white" href="{{ url('admin/polls/'.$poll->id.'/questions/create') }}">Add New Question</a>
                    <?php
                        }
                    ?>

                    <a class="btn btn-dark text-white" href="{{ url('admin/surveys/'.$poll->id.'-'.Str::slug($poll->title)) }}">Take Survey</a>
                </p>
                {{-- @include('backend.partials.message'); --}}
            </div>
            <div class="card-body">
                @foreach ($poll->questions as $index => $question)
                    <div class="card">
                        <div class="card-header">{{ $question->question }}
                            <span class="text-bold">
                                 Total -
                                  {{ $question->responses->count() }}
                                 Votes
                            </span>
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

                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($question->answers as $answer)
                                    <li class="list-group-item">
                                        <p class="float-left">{{ $answer->answer }}</p>
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
                                    </li>
                                @endforeach
                            </ul>
                            <div class="row">
                                <div class="col-12" id="accordion">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4 class="card-title text-center w-100">
                                                <a href="{{ route('admin.poll.statistics', ['pid' => $poll->id,'qid' => $question->id]) }}">View Statistics</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-left w-100">
                                User Responses
                            </h4>
                        </div>
                        <div class="card-body">
                            @php
                                $user = App\Models\SurveyResponse::where('question_id',$question->id)->get();
                            @endphp

                                @foreach ($user as $user)
                                    <?php
                                        $showuser = App\Models\User::where('id',$user->user_id)->first();
                                    ?>
                                    @if(!empty($showuser))
                                    <div class="card">
                                        <div class="card-body">
                                                <table>
                                                    <tr>
                                                        <td><strong>Name:</strong></td>
                                                        <td>&nbsp;</td>
                                                        <td>{{ $showuser->fname }} {{ $showuser->lname }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Whatsapp Number: </strong> </td>
                                                        <td>&nbsp;</td>
                                                        <td>{{ $showuser->whatsapp_number }}</td>
                                                    </tr>
                                                </table>
                                        </div>
                                    </div>

                                    @endif
                                @endforeach


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
