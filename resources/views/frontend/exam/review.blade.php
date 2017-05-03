@extends('frontend.layout.default')
@section('content')
    <div class="container-fluid">
        <div class="row exam-review">
            <div class="col-md-3">
                <div class="panel panel-success quiz-review-nav affix">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Quiz Navigation
                        </h3>
                    </div>
                    <div class="panel-body">
                        @foreach($result->rsAnswers as $k => $rs)
                            <span class="{{($rs->answer == $rs->question->answers()
                            ->where('is_correct', 1)->first()->id) ? 'correct' : 'incorrect'}}">{{ $k+1 }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-9 column">
                <?php $completeP = ($result->rsAnswers()->where('correct', 1)->count() / $result->rsAnswers()->count()) * 100 ?>
                <p class="lead">Kết quả đạt được {{$completeP}}%</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{$completeP}}%;">
                        <span class="sr-only">Completo al {{$completeP}}%</span>
                    </div>
                </div>
                @foreach($rsAnswers as $k => $rs)
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Câu {{$k + 1}}: {{ $rs->question->content }}
                            </h3>
                        </div>
                        <div class="panel-body">
                            @foreach($rs->question->answers as $a)
                                <div class="radio">
                                    <label {{ ($a->is_correct ==1) ? 'class=correct' : null }}>
                                        <input name="Result[{{ $rs->question->id }}]" value="{{ $a->id }}"
                                               {{ ($a->id == $rs->answer) ? 'checked' : null }}
                                               type="radio">
                                        {{ $a->content }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                {{ $rsAnswers->links() }}
            </div>
        </div>
    </div>
@endsection