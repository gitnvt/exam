@extends('backend.layout.default')
@section('content')
    <div id="subject-list">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Danh sách ngân hàng câu hỏi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="exam" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Môn thi</th>
                        <th>Hướng dẫn</th>
                        <th>Hiển thị đáp án đúng</th>
                        <th>Thời gian làm bài</th>
                        <th>Trạng thái</th>
                        <th class="th-action">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->subject->name }}</td>
                            <td>{{ $d->instruction }}</td>
                            <td>{{ $d->show_answer_correct }}</td>
                            <td>{{ $d->total_time }}</td>
                            <td>{{ $d->status }}</td>
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
            $("#exam").DataTable({
                "aaSorting": [],
            });
        });
    </script>
@stop