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
                                <label for="Semester[name]">Học kỳ</label>
                                <input class="form-control" name="Semester[name]" placeholder="Enter Name" type="text">
                            </div>
                            <div class="form-group">
                                <label for="Semester[sholastic_id]">Năm học</label>
                                <select class="form-control" name="Semester[scholastic_id]">
                                    <option value="">Chọn năm học</option>
                                    @foreach($scholastic as $s)
                                        <option value="{{$s->id}}">{{$s->title}}</option>
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