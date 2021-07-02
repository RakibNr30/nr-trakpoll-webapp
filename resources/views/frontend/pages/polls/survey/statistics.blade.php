@extends('frontend.pages.layouts.master')

@section('title')
    {{ $question->question }}
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
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Survey</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin', ['polls', $poll->id]) }}">Survey</a></li>
                            <li class="breadcrumb-item active">Statistics</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">{{ $question->question }}</h2>
                <br>
                <span class="text-success">
                    Total Votes #<span id="total-vote">{{ $question->responses->count() }}</span><br>
                </span>
                <span class="text-info">
                    <?php
                        $responses = $question->responses;

                        $info = App\Models\SurveyResponse::where('question_id',$question->id)
                                            ->where('user_id',Auth::guard('web')->user()->id)
                                            ->first();
                        if($info){
                            $ans = App\Models\Answer::where('id',$info->answer_id)->first()->answer;
                        ?>
                        My Vote:
                        <span id="total-vote" class="text-success">
                        <?php
                            echo $ans;
                        ?>
                        </span>
                        <?php
                        }
                        else{
                        ?>
                        <span id="total-vote" class="text-danger">
                            <?php
                                echo "Not Participated Yet";
                            ?>
                        </span>
                        <?php
                        }
                        ?>

            </div>
            <div class="card-header">
                <div class="row">
                    <div class="form-group col-md-6 mb-0">
                        <label>Choose Parameter</label>
                        <select name="category" class="form-control" id="search_category">
                            <option value="all">All</option>
                            <option value="gender">Gender</option>
                            <option value="age">Age</option>
                            <option value="country">Country</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 mb-0">
                        <label>Selcet Value</label>
                        <select name="subcategory" class="form-control select22" id="search_subcategory">
                            <option value="all">All</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="pie-chart" style="height: 500px"></canvas>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <style>
        .select2-container .select2-selection--single {
            height: 38px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            margin-top: 2px;
        }
        @media only screen and (max-width: 767px) {
            .select2-container .select2-selection--single {
                margin-top: 10px;
            }
            .select2-container--default .select2-selection--single .select2-selection__arrow b {
                margin-top: 11px;
            }
        }
    </style>
@stop

@section('script')
    <script src="{{ asset('backend/plugins/new-chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/new-chartjs/datalabels.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select22').select2();
        })
    </script>
    <script type="text/javascript">

        var pollChart;

        if (typeof pollChart != "undefined") {
            pollChart.destroy();
        }

        var data = [{
            label: '# of Votes',
            data: {!! json_encode($votes) !!},
            backgroundColor: [
                "rgba(14, 149, 68, 0.7)",
                "rgba(205, 92, 92, 0.7)",
                "rgba(212, 172, 13, 0.7)",
                "rgba(52, 73, 94, 0.7)",
                "rgba(91, 44, 111, 0.7)",
                "rgba(14, 149, 68, 0.7)",
                "rgba(205, 92, 92, 0.7)",
                "rgba(212, 172, 13, 0.7)",
                "rgba(52, 73, 94, 0.7)",
                "rgba(91, 44, 111, 0.7)"
            ],
            borderColor: [
                "rgba(14, 149, 68, 1)",
                "rgba(205, 92, 92, 1)",
                "rgba(212, 172, 13, 1)",
                "rgba(52, 73, 94, 1)",
                "rgba(91, 44, 111, 1)",
                "rgba(14, 149, 68, 1)",
                "rgba(205, 92, 92, 1)",
                "rgba(212, 172, 13, 1)",
                "rgba(52, 73, 94, 1)",
                "rgba(91, 44, 111, 1)"
            ]
        }];
        var options = {
            tooltips: {
                enabled: true
            },
            scales: {
                yAxes: [{
                    barPercentage: 1.0,
                    gridLines: {
                        display: true
                    },
                    ticks: {
                        fontSize: 12,
                        beginAtZero: true,
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: true
                    },
                    ticks: {
                        min: 0,
                        max: 100,
                        stepSize: 20
                    }
                }]
            },
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                "display": true
            },
            plugins: {
                datalabels: {
                    formatter: (value, ctx) => {
                        let sum = ctx.dataset._meta[0].total;
                        if (sum == 0) return '';
                        return (value * 100 / sum).toFixed(2) + "%";
                    },
                    font: {
                        weight: 'bold',
                        size: 12
                    },
                    color: data[0].borderColor
                }
            }
        };
        var ctx = document.getElementById("pie-chart").getContext('2d');
        pollChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($answers) !!},
                datasets: data
            },
            options: options,
        });


        //////////////////////////////////////////////////////////////////////////

        $('#search_category').on('change', function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/poll/question/statistics/category',
                type: "POST",
                data: {
                    _token: CSRF_TOKEN,
                    qid: {{ $question->id }},
                    category: $('#search_category').val(),
                },
                success: function (res) {
                    $("#search_subcategory").html('');
                    $.each(res.subCategories, function (index, subCategory) {
                        $("#search_subcategory").append('<option value="'+index+'">'+subCategory+'</option>');
                    });
                    $("#total-vote").text(array_sum(res.votes));

                    if (typeof pollChart != "undefined") {
                        pollChart.destroy();
                    }
                    var data = [{
                        label: '# of Votes',
                        data: res.votes,
                        backgroundColor: [
                            "rgba(14, 149, 68, 0.7)",
                            "rgba(205, 92, 92, 0.7)",
                            "rgba(212, 172, 13, 0.7)",
                            "rgba(52, 73, 94, 0.7)",
                            "rgba(91, 44, 111, 0.7)",
                            "rgba(14, 149, 68, 0.7)",
                            "rgba(205, 92, 92, 0.7)",
                            "rgba(212, 172, 13, 0.7)",
                            "rgba(52, 73, 94, 0.7)",
                            "rgba(91, 44, 111, 0.7)"
                        ],
                        borderColor: [
                            "rgba(14, 149, 68, 1)",
                            "rgba(205, 92, 92, 1)",
                            "rgba(212, 172, 13, 1)",
                            "rgba(52, 73, 94, 1)",
                            "rgba(91, 44, 111, 1)",
                            "rgba(14, 149, 68, 1)",
                            "rgba(205, 92, 92, 1)",
                            "rgba(212, 172, 13, 1)",
                            "rgba(52, 73, 94, 1)",
                            "rgba(91, 44, 111, 1)"
                        ]
                    }];
                    var options = {
                        tooltips: {
                            enabled: true
                        },
                        scales: {
                            yAxes: [{
                                barPercentage: 1.0,
                                gridLines: {
                                    display: true
                                },
                                ticks: {
                                    fontSize: 12,
                                    beginAtZero: true,
                                }
                            }],
                            xAxes: [{
                                gridLines: {
                                    display: true
                                },
                                ticks: {
                                    min: 0,
                                    max: 100,
                                    stepSize: 20
                                }
                            }]
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        legend: {
                            "display": true
                        },
                        plugins: {
                            datalabels: {
                                formatter: (value, ctx) => {
                                    let sum = array_sum(data[0].data);
                                    if (sum == 0) return '';
                                    return (value * 100 / sum).toFixed(2) + "%";
                                },
                                font: {
                                    weight: 'bold',
                                    size: 12
                                },
                                color: data[0].borderColor
                            }
                        }
                    };
                    var ctx = document.getElementById("pie-chart").getContext('2d');
                    pollChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: res.answers,
                            datasets: data
                        },
                        options: options,
                    });
                }
            });
        });

        //////////////////////////////////////////////////////////////////////////

        $('#search_subcategory').on('change', function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/poll/question/statistics',
                type: "POST",
                data: {
                    _token: CSRF_TOKEN,
                    pid: {{ $poll->id }},
                    qid: {{ $question->id }},
                    category: $('#search_category').val(),
                    subcategory: $('#search_subcategory').val(),
                },
                success: function(res) {
                    if (typeof pollChart != "undefined") {
                        pollChart.destroy();
                    }
                    $("#total-vote").text(array_sum(res.votes));
                    var data = [{
                        label: '# of Votes',
                        data: res.votes,
                        backgroundColor: [
                            "rgba(14, 149, 68, 0.7)",
                            "rgba(205, 92, 92, 0.7)",
                            "rgba(212, 172, 13, 0.7)",
                            "rgba(52, 73, 94, 0.7)",
                            "rgba(91, 44, 111, 0.7)",
                            "rgba(14, 149, 68, 0.7)",
                            "rgba(205, 92, 92, 0.7)",
                            "rgba(212, 172, 13, 0.7)",
                            "rgba(52, 73, 94, 0.7)",
                            "rgba(91, 44, 111, 0.7)"
                        ],
                        borderColor: [
                            "rgba(14, 149, 68, 1)",
                            "rgba(205, 92, 92, 1)",
                            "rgba(212, 172, 13, 1)",
                            "rgba(52, 73, 94, 1)",
                            "rgba(91, 44, 111, 1)",
                            "rgba(14, 149, 68, 1)",
                            "rgba(205, 92, 92, 1)",
                            "rgba(212, 172, 13, 1)",
                            "rgba(52, 73, 94, 1)",
                            "rgba(91, 44, 111, 1)"
                        ]
                    }];
                    var options = {
                        tooltips: {
                            enabled: true
                        },
                        scales: {
                            yAxes: [{
                                barPercentage: 1.0,
                                gridLines: {
                                    display: true
                                },
                                ticks: {
                                    fontSize: 12,
                                    beginAtZero: true,
                                }
                            }],
                            xAxes: [{
                                gridLines: {
                                    display: true
                                },
                                ticks: {
                                    min: 0,
                                    max: 100,
                                    stepSize: 20
                                }
                            }]
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        legend: {
                            "display": true
                        },
                        plugins: {
                            datalabels: {
                                formatter: (value, ctx) => {
                                    let sum = array_sum(data[0].data);
                                    if (sum == 0) return '';
                                    return (value * 100 / sum).toFixed(2) + "%";
                                },
                                font: {
                                    weight: 'bold',
                                    size: 12
                                },
                                color: data[0].borderColor
                            }
                        }
                    };
                    var ctx = document.getElementById("pie-chart").getContext('2d');
                    pollChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: res.answers,
                            datasets: data
                        },
                        options: options,
                    });
                }
            });
        });

        function array_sum(arr) {
            var sum = 0;
            for (var i = 0; i<arr.length; i++) {
                sum += arr[i];
            }
            return sum;
        }
    </script>
@stop
