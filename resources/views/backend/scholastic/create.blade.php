@extends('backend.layout.default')
@section('content')
    <div id="create-scholastic">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm năm học mới</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="Scholastic[title]">Title</label>
                                <input class="form-control" name="Scholastic[title]" placeholder="Enter title" type="text">
                            </div>
                            <div class="form-group">
                                <label for="Scholastic[start]">Start Time</label>
                                <input class="form-control" name="Scholastic[start]" placeholder="Start Time" type="text">
                            </div>
                            <div class="form-group">
                                <label for="Scholastic[end]">End Time</label>
                                <input class="form-control" name="Scholastic[end]" placeholder="End Time" type="text">
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