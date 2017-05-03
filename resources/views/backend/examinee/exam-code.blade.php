@extends('backend.layout.default')
@section('content')
    <div id="subject-list">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Danh sách thí sinh</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="exam-code" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>UserName</th>
                        <th>Môn thi</th>
                        <th>Đề thi</th>
                        <th>Mã đề</th>
                        <th class="th-action">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($examCodes as $ec)
                        <?php
                            $exam = \App\Exams::where('id', \App\Examcode::where('exam_code', $ec)->first()->exam_id)->first();
                        ?>
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $exam->subject->name }}</td>
                            <td>{{ $exam->title }}</td>
                            <td>{{ $ec }}</td>
                            <td class="user-action text-center">
                                <a title="Detail" href="/examinee/preview/{{$ec}}" target="_blank">
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
            $("#exam-code").DataTable({
                "aaSorting": [],
            });
        });
    </script>
@stop