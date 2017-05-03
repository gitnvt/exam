@extends('frontend.layout.default')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-success quiz-nav affix">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Quiz Navigation
                        </h3>
                    </div>
                    <div class="panel-body">
                        @foreach($questions as $k => $q)
                            <span class="q-{{$q->id}}" onclick="scrollToQuestion({{$q->id}})">{{ $k+1 }}</span>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-9 column">
                <div class="row">
                    <div class="col-md-3">
                        <p class="lead">Thời gian làm bài: </p>
                    </div>
                    <div class="col-md-3">
                        <p id="countdown-timer" class="lead"></p>
                    </div>
                </div>
                <form class="form-horizontal" method="POST" action="/exam/quiz/{{ $data['draftResult']->id }}">
                    {{ csrf_field() }}
                    <?php $i=1;?>
                    @foreach($questions as $q)
                        <div class="panel panel-primary" id="qs-{{$q->id}}">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    Câu {{$i}}: {{ $q->content }}
                                </h3>
                            </div>
                            <div class="panel-body">
                                @foreach($q->answers as $a)
                                    <div class="radio">
                                        <label>
                                            <input name="Result[{{ $q->id }}]" value="{{ $a->id }}"
                                                   result_id="{{ $data['draftResult']->id }}"
                                                   question_id="{{ $q->id }}"
                                                   type="radio" onclick="draftAnswer($(this).attr('result_id'), $(this).attr('question_id'), $(this).val());">
                                            {{ $a->content }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <?php $i++; ?>
                    @endforeach
                    <button class="btn btn-success">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        <?php $max = date('Y/m/d H:i:s', strtotime($data['draftResult']->start_time) + $data['exam']->total_time*60);?>
        $("#countdown-timer").countdown("{{$max}}", function(event) {
                $(this).text(
                    event.strftime('%H:%M:%S')
                );
            });
    </script>
@endsection