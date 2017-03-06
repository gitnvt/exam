@extends('backend.layout.default')
@section('content')
    <div id="subject-list">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Danh sách các năm học đã tạo</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Năm học</th>
                        <th>Bắt đầu</th>
                        <th>Kết thúc</th>
                        <th>Thời gian tạo</th>
                        <th>Thời gian cập nhật</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->title }}</td>
                            <td>{{ $d->start }}</td>
                            <td>{{ $d->end }}</td>
                            <td>{{ date('d-m-Y', strtotime($d->created_at)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($d->updated_at)) }}</td>
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
    <script>
        $(function () {
            $("#example1").DataTable({
                "aaSorting": [],
            });
        });
    </script>
@stop