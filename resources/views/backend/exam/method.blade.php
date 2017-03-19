@extends('backend.layout.default')
@section('content')
    <div id="exam-matrix">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Cách lấy câu hỏi</h3>
            </div>
            <!-- /.box-header -->
            <?php
                $query = \App\ExamMatrix::select(\Illuminate\Support\Facades\DB::raw('SUM(quantity) as total'))
                ->where('exam_id', $exam->id);

            ?>
            <div class="box-body">
                <form method="POST">
                    {{ csrf_field() }}
                    <table id="exam-method" class="table table-bordered">
                        <thead style="background: #ccc">
                        <tr>
                            <th width="30%">Khối kiến thức</th>
                            <th width="30%">Độ khó</th>
                            <th width="20%">Số câu</th>
                            <th>Cách lấy câu hỏi</th>
                        </tr>
                        </thead>
                        <tbody style="background: #eee">
                        @foreach($exam->examMatrix as $em)
                            <tr>
                                <td>{{$em->term->name}}</td>
                                <td>{{$em->level->name}}</td>
                                <td>{{$em->quantity}}</td>
                                <td>
                                    <select class="form-control">
                                        <option>Chọn phương thức</option>
                                        <option data-toggle="modal" data-target="#random_{{$em->term_id}}_{{$em->level_id}}">
                                            Random from bank
                                        </option>
                                        <option data-toggle="modal" data-target="#manual_{{$em->term_id}}_{{$em->level_id}}">
                                            Manual
                                        </option>
                                    </select>

                                    <!-- Modal Random-->
                                    <div id="random_{{$em->term_id}}_{{$em->level_id}}" class="modal fade" role="dialog">
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
                                                        <select class="form-control" name="Random[{{$em->term_id}}][{{$em->level_id}}]">
                                                            <option value="">Chọn ngân hàng</option>
                                                            <?php
                                                            $banks = \App\QuestionBanks::get();
                                                            ?>
                                                            @foreach($banks as $b)
                                                                <option value="{{$b->id}}-{{$em->quantity}}">
                                                                    {{ $b->name }} ( {{ $b->questions()->where('subject_id', $exam->subject_id)
                                                                    ->where('term_id', $em->term_id)->where('level', $em->level_id)->count() }} )
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

                                    <!-- Modal Manual -->
                                    <div id="manual_{{$em->term_id}}_{{$em->level_id}}" class="modal fade" role="dialog">
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
                                                                        '<?php echo $em->id ?>',
                                                                        $(this).val()
                                                                        )">
                                                            <?php
                                                            $banks = \App\QuestionBanks::get();
                                                            ?>
                                                            <option value="">Chọn ngân hàng</option>
                                                            @foreach($banks as $b)
                                                                <option value="{{$b->id}}">
                                                                    {{ $b->name }} ( {{ $b->questions()->where('subject_id', $exam->subject_id)
                                                                    ->where('term_id', $em->term_id)->where('level', $em->level_id)->count() }} )
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