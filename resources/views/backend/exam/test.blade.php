@extends('backend.layout.default')
@section('content')
    <div id="exam-matrix">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Ma trận đề</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="exam" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Khối kiến thức</th>
                        @foreach($levels as $lv)
                            <th>{{ $lv->name }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subject->terms as $term)
                        <tr>
                            <td>{{ $term->name }}</td>
                            @foreach($levels as $lv)
                                <td>
                                    <select class="form-control">
                                        <option value="">Options</option>
                                        <option data-toggle="modal" data-target="#random_{{$term->id}}_{{$lv->id}}">
                                            Random from bank
                                        </option>
                                        <option data-toggle="modal" data-target="#manual_{{$term->id}}_{{$lv->id}}">
                                            Manual
                                        </option>
                                    </select>
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
                                                        <select class="form-control">
                                                            {{--<option value="">Chọn ngân hàng</option>--}}
                                                            <?php
                                                            $banks = \App\QuestionBanks::get();
                                                            ?>
                                                            @foreach($banks as $b)
                                                                <option value="">
                                                                    {{ $b->name }} ( {{ $b->questions()->where('subject_id', $exam->subject_id)
                                                                    ->where('term_id', $term->id)->where('level', $lv->id)->count() }} )
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Close
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
                                                    <p>Some text in the modal.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Close
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
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@endsection

@section('js')
    <script src="/backend/js/script.js"></script>
@stop