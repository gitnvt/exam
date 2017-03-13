@extends('backend.layout.default')
@section('content')
    <div id="exam-matrix">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Ma trận đề</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST">
                    {{ csrf_field() }}
                    <label style="padding: 8px;">Tổng số câu hỏi: <span id="total-questions">0</span></label>
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
                                            $totalQuestions = $subject->questions()->where('term_id', $term->id)
                                                ->where('level', $lv->id)->count();
                                        ?>
                                        <input class="form-control exam-matrix-item" type="number" name="ExamMatrix[{{$term->id}}][{{$lv->id}}]"
                                        min="0" max="{{$totalQuestions}}" {{($totalQuestions == 0) ? 'disabled' : null }} value="0"
                                        onkeyup="totalQuestions()" onclick="totalQuestions()">
                                        <span class="input-group-btn">
                                          <label class="btn btn-info btn-flat">
                                              / {{$totalQuestions}} câu
                                          </label>
                                        </span>
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