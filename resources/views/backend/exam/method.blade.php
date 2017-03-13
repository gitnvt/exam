@extends('backend.layout.default')
@section('content')
    <div id="exam-matrix">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Chọn câu hỏi</h3>
            </div>
            <!-- /.box-header -->
            <?php
                $query = \App\ExamMatrix::select(\Illuminate\Support\Facades\DB::raw('SUM(quantity) as total'))
                ->where('exam_id', $exam->id);

            ?>
            <div class="box-body">
                <form method="POST">
                    {{ csrf_field() }}
                    <label style="padding: 8px;">Tổng số câu hỏi:
                        <span id="total-questions">
                            {{$query->first()->total}}
                        </span>
                    </label>
                    <table id="exam" class="table table-bordered">
                        <thead style="background: #ccc">
                        <tr>
                            <th>Khối kiến thức</th>
                            @foreach($levels as $lv)
                                <th>{{ $lv->name }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody style="background: #eee">
                        @foreach($subject->terms as $term)
                            <tr>
                                <td>{{ $term->name }}</td>
                                @foreach($levels as $lv)
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <?php
                                                $queryTemp = clone($query);
                                                $totalQuestions = $queryTemp->where('term_id', $term->id)->where('level_id', $lv->id)->first();
                                                $examMatrix = \App\ExamMatrix::where('term_id', $term->id)->where('level_id', $lv->id)->first();
                                                if($examMatrix){
                                                    $examMatrixId = $examMatrix->id;
                                                    $exQuantity = $examMatrix->quantity;
                                                }
                                                else{
                                                    $examMatrixId = 0;
                                                    $exQuantity = 0;
                                                }
                                                ?>
                                                <select class="form-control" {{($totalQuestions->total)?null:'disabled'}}>
                                                    <option value="">Options</option>
                                                    <option data-toggle="modal" data-target="#random_{{$term->id}}_{{$lv->id}}">
                                                        Random from bank
                                                    </option>
                                                    <option data-toggle="modal" data-target="#manual_{{$term->id}}_{{$lv->id}}">
                                                        Manual
                                                    </option>
                                                </select>
                                            <span class="input-group-btn">
                                              <label class="btn btn-info btn-flat">
                                                  chọn {{($totalQuestions->total)?$totalQuestions->total:0}} câu
                                              </label>
                                            </span>
                                        </div>
                                        <!-- Modal -->
                                        <div id="random_{{$term->id}}_{{$lv->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Chọn câu hỏi random</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Chọn ngân hàng câu hỏi</label>
                                                            <select class="form-control" name="Random[{{$term->id}}][{{$lv->id}}]"
                                                                    {{($totalQuestions->total)?null:'disabled'}}>
                                                                <option value="">Chọn ngân hàng</option>
                                                                <?php
                                                                $banks = \App\QuestionBanks::get();
                                                                ?>
                                                                @foreach($banks as $b)
                                                                    <option value="{{$b->id}}-{{$exQuantity}}">
                                                                        {{ $b->name }} ( {{ $b->questions()->where('subject_id', $exam->subject_id)
                                                                    ->where('term_id', $term->id)->where('level', $lv->id)->count() }} )
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">
                                                            Xong
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div id="manual_{{$term->id}}_{{$lv->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Chọn câu hỏi thủ công</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Chọn ngân hàng câu hỏi</label>
                                                            <select class="form-control" class="manual-from-bank"
                                                                    onchange="manualGetQuestions(
                                                                        '<?php echo $examMatrixId ?>',
                                                                            $(this).val()
                                                                            )"
                                                                    {{($totalQuestions->total)?null:'disabled'}}>
                                                                <option value="">Chọn ngân hàng</option>
                                                                <?php
                                                                $banks = \App\QuestionBanks::get();
                                                                ?>
                                                                @foreach($banks as $b)
                                                                    <option value="{{$b->id}}">
                                                                        {{ $b->name }} ( {{ $b->questions()->where('subject_id', $exam->subject_id)
                                                                    ->where('term_id', $term->id)->where('level', $lv->id)->count() }} )
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <table class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>Chọn</th>
                                                                <th>Câu hỏi</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                {{--<tr>--}}
                                                                    {{--<td>--}}
                                                                        {{--<div class="checkbox" style="margin: 0;">--}}
                                                                            {{--<label style="font-size: 1.1em; padding-left: 0;">--}}
                                                                                {{--<input value="" name="ExamQuestion[]" type="checkbox">--}}
                                                                                {{--<span class="cr"><i class="cr-icon fa fa-check"></i></span>--}}
                                                                            {{--</label>--}}
                                                                        {{--</div>--}}
                                                                    {{--</td>--}}
                                                                    {{--<td></td>--}}
                                                                {{--</tr>--}}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">
                                                            Xong
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-success">Tiếp theo</button>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@endsection

@section('js')
    <script src="/backend/js/script.js"></script>
@stop