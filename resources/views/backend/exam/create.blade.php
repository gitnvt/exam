@extends('backend.layout.default')
@section('content')
    <div id="create-scholastic">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sinh đề thi</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="Exam[subject_id]">Chọn môn thi</label>
                                    <select class="form-control" name="Exam[subject_id]">
                                        <option value="">Chọn môn thi</option>
                                        @foreach($subjects as $sub)
                                            <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="Exam[title]">Tên đề thi</label>
                                    <input class="form-control" name="Exam[title]" type="text" />
                                </div>
                            </div>
                            {{--<div class="form-group row">--}}
                                {{--<div class="col-md-3">--}}
                                    {{--<label for="Exam[start_time]">Thời gian bắt đầu</label>--}}
                                    {{--<div class="input-group">--}}
                                        {{--<input id="start-time" name="Exam[start_time]" class="form-control date"--}}
                                               {{--data-date-format="dd-mm-yyyy H:i" type="text" readonly/>--}}
                                        {{--<span class="input-group-addon"><i--}}
                                                    {{--class="glyphicon glyphicon-calendar"></i></span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-3">--}}
                                    {{--<label for="Exam[end_time]">Thời gian kết thúc</label>--}}
                                    {{--<div class="input-group">--}}
                                        {{--<input id="end-time" name="Exam[end_time]" class="form-control date"--}}
                                               {{--data-date-format="dd-mm-yyyy H:i" type="text" readonly/>--}}
                                        {{--<span class="input-group-addon"><i--}}
                                                    {{--class="glyphicon glyphicon-calendar"></i></span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="Exam[instruction]">Hướng dẫn</label>
                                    <textarea class="form-control" name="Exam[instruction]" placeholder="Instruction"
                                              rows="3">

                                    </textarea>
                                </div>
                            </div>
                            {{--<div class="form-group row">--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<label for="Exam[show_answer_correct]">Hiển thị đáp án đúng</label>--}}
                                    {{--<div class="funkyradio">--}}
                                        {{--<div class="funkyradio-info" style="margin-right: 10px;">--}}
                                            {{--<input type="radio" name="Exam[show_answer_correct]" value="1"--}}
                                                   {{--id="show-answer" checked/>--}}
                                            {{--<label for="show-answer">Có</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="funkyradio-default">--}}
                                            {{--<input type="radio" name="Exam[show_answer_correct]" value="0" id="dont-show"/>--}}
                                            {{--<label for="dont-show">Không</label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<label for="Exam[status]">Trạng thái</label>--}}
                                    {{--<div class="funkyradio">--}}
                                        {{--<div class="funkyradio-info" style="margin-right: 10px;">--}}
                                            {{--<input type="radio" name="Exam[status]" value="1" id="active" checked/>--}}
                                            {{--<label for="active">Active</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="funkyradio-default">--}}
                                            {{--<input type="radio" name="Exam[status]" value="0" id="inactive"/>--}}
                                            {{--<label for="inactive">Inactive</label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row">--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<label for="Exam[method]">Lựa chọn cách lấy câu hỏi</label>--}}
                                    {{--<div class="funkyradio">--}}
                                        {{--<div class="funkyradio-info" style="margin-right: 10px;">--}}
                                            {{--<input type="radio" name="Exam[method]" value="{{ \App\Exams::RANDOM }}" id="random-question"--}}
                                                   {{--checked/>--}}
                                            {{--<label for="random-question">Random</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="funkyradio-info">--}}
                                            {{--<input type="radio" name="Exam[method]" value="{{ \App\Exams::MANUAL }}" id="manual-question"/>--}}
                                            {{--<label for="manual-question">Thủ công</label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="Exam[total_time]">Tổng thời gian làm bài</label>
                                    {{--<input class="form-control" name="Exam[total_time]" placeholder="Total Time" type="text">--}}
                                    <div class="input-group input-group-sm">
                                        <input class="form-control" type="number" name="Exam[total_time]">
                                        <span class="input-group-btn">
                                          <label class="btn btn-info btn-flat">Phút</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Tiếp theo</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection
@section('css')
    @parent
    <link href="/libs/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
@stop
@section('js')
    @parent
    <script type="text/javascript" src="/libs/datetimepicker/datetimepicker.js" charset="UTF-8"></script>
    <script>
        $('#start-time').datetimepicker({
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1
        });
        $('#end-time').datetimepicker({
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1
        });
    </script>
@stop