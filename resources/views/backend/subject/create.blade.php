@extends('backend.layout.default')
@section('content')
    <div id="create-scholastic">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm học kỳ mới</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="Subject[code]">Mã môn học</label>
                                <input class="form-control" name="Subject[code]" placeholder="Enter Subject Code" type="text">
                            </div>

                            <div class="form-group">
                                <label for="Subject[name]">Tên môn học</label>
                                <input class="form-control" name="Subject[name]" placeholder="Enter Subject Name" type="text">
                            </div>

                            <div class="form-group">
                                <label for="Subject[description]">Giới thiệu chung môn học</label>
                                <textarea class="form-control" name="Subject[description]" placeholder="Enter Description" row="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="Subject[sholastic_id]">Học kỳ</label>
                                <select class="form-control" name="Subject[semester_id]">
                                    <option value="">Chọn học kỳ</option>
                                    @foreach($semester as $se)
                                        <option value="{{$se->id}}">{{$se->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="Subject[sholastic_id]">Năm học</label>
                                <select class="form-control" name="Subject[scholastic_id]">
                                    <option value="">Chọn năm học</option>
                                    @foreach($scholastic as $sc)
                                        <option value="{{$sc->id}}">{{$sc->title}}</option>
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