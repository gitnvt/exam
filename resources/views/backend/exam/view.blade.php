@extends('backend.layout.default')
@section('content')
    <div id="exam-matrix">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Đề thi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    <label>Tổng số câu hỏi: <span id="total-questions">{{ $exam->total_questions }}</span></label>
                </div>
                <table id="matrix-preview" class="table table-bordered">
                    <thead style="background: #ccc">
                    <tr>
                        <th width="20%">Khối kiến thức</th>
                        <th width="20%">Độ khó</th>
                        <th width="15%">Số câu</th>
                        <th>Danh sách câu hỏi</th>
                    </tr>
                    </thead>
                    <tbody style="background: #eee">
                    @foreach($exam->examMatrix as $em)
                        <tr>
                            <td>{{$em->term->name}}</td>
                            <td>{{$em->level->name}}</td>
                            <td>
                                {{$em->quantity}}
                            </td>
                            <td>
                                @if($em->is_random)
                                    Random từ ngân hàng "{{$em->bank->name}}"
                                @else
                                    <?php
                                        $questions = $exam->questions()->where('term_id', $em->term_id)->where('level', $em->level_id)->get();
                                    ?>
                                    <ul style="padding-left: 15px;">
                                    @foreach($questions as $q)
                                        <li>{{$q->content}}</li>
                                    @endforeach
                                    </ul>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@endsection

@section('js')
    <script src="/backend/js/script.js"></script>
@stop