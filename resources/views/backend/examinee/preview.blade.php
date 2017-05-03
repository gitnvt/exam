@extends('frontend.layout.default')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>

            <div class="col-md-10 column">
                <div class="form-horizontal">
                    <?php $i=1;?>
                    @foreach($questions as $q)
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    Câu {{$i}}: {{ $q->content }}
                                </h3>
                            </div>
                            <div class="panel-body">
                                @foreach($q->answers as $a)
                                    <div class="radio">
                                        <label>
                                            <input question_id="{{ $q->id }}"
                                                   type="radio">
                                            {{ $a->content }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <?php $i++; ?>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection