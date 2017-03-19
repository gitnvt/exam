@extends('backend.layout.default')
@section('content')
    <div id="exam-matrix">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Ma trận đề</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    <label>Tổng số câu hỏi: <span id="total-questions">{{ $exam->total_questions }}</span></label>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="">Khối kiến thức</label>
                            <select id="select-term" class="form-control" onchange="termSelected('{{$exam->subject_id}}', $(this).val())">
                                <option value="">Chọn khối kiến thức</option>
                                @foreach($subject->terms as $term)
                                    <?php
                                    $totalQuestions = $subject->questions()->where('term_id', $term->id)->count();
                                    ?>
                                    <option value="{{ $term->id }}" d-name="{{$term->name}}">
                                        {{ $term->name }} ( {{$totalQuestions}} )
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Select Level</label>
                            <select class="form-control" id="select-level">
                                <option>Select Level</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="">Số câu</label>
                            <input id="number-questions" class="form-control" type="number" min="0">
                        </div>
                        <div class="col-md-2">
                            <button id="btn-add" class="btn btn-success" style="margin-top: 25px;"
                            onclick="addNewExRow($('#select-term').val(), $('#select-term').find('option:selected').attr('d-name'),
                            $('#select-level').val(), $('#select-level').find('option:selected').attr('d-name'), $('#number-questions').val())">
                                Add
                            </button>
                        </div>
                    </div>
                </div>

                <form method="POST">
                    {{ csrf_field() }}
                    <table id="matrix-preview" class="table table-bordered">
                        <thead style="background: #ccc">
                        <tr>
                            <th width="35%">Khối kiến thức</th>
                            <th width="35%">Độ khó</th>
                            <th width="20%">Số câu</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody style="background: #eee">
                        @foreach($exam->examMatrix as $em)
                            <tr>
                                <td>{{$em->term->name}}</td>
                                <td>{{$em->level->name}}</td>
                                <td>
                                    <input class="form-control" name="ExamMatrix[{{$em->term_id}}][{{$em->level_id}}]" type="number"
                                           value="{{$em->quantity}}">
                                </td>
                                <td class="text-center">
                                    <i style="color: red;cursor: pointer;font-size: 18px;padding-top: 6px;"
                                       class="fa fa-minus-circle remove-item" aria-hidden="true" onclick="removeItem($(this))">
                                    </i>
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