@extends('backend.layout.default')
@section('content')
    <div id="subject-list">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Danh sách ngân hàng câu hỏi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="subject" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mã môn học</th>
                        <th>Tên môn học</th>
                        <th>Học kỳ</th>
                        <th>Năm học</th>
                        <th>Số lượng câu hỏi</th>
                        <th class="th-action">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->code }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->semester->name }}</td>
                            <td>{{ $d->scholastic->title }}</td>
                            <td>{{ $d->questions()->count() }}</td>
                            <td class="user-action text-center">
                                <a title="Import" href="/question-bank/import/{{$d->id}}" target="_blank">
                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                </a>
                                <a title="Detail" href="#" target="_blank">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
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
    <script>
        $(function () {
            $("#subject").DataTable({
                "aaSorting": [],
            });
        });
    </script>
@stop