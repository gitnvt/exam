@extends('backend.layout.default')
@section('content')
    <div id="create-scholastic">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sinh mã đề cho sinh viên</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST">
                        {{ csrf_field() }}
                        <div class="box-body">
                            {{--<div class="form-group">--}}
                                {{--<label for="Semester[name]">Học kỳ</label>--}}
                                {{--<input class="form-control" name="Semester[name]" placeholder="Enter Name" type="text">--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <label for="ExamId]">Chọn đề thi</label>
                                <select class="form-control" name="ExamId">
                                    @foreach($exams as $e)
                                        <option value="{{$e->id}}">{{$e->title}} môn {{$e->subject->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection