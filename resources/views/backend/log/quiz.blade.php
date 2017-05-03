@extends('backend.layout.default')
@section('content')
    <div id="subject-list">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Danh sách ngân hàng câu hỏi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="log-system" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Activity</th>
                        <th>Exam</th>
                        <th>Subject</th>
                        <th>Exam code</th>
                        <th>Created time</th>
                        <th>Detail</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($logActivities as $activity)
                        <tr>
                            <td>{{ $activity->id }}</td>
                            <td>{{ ($activity->user) ? $activity->user->name : '' }}</td>
                            <td>{{ json_decode($activity->text)->title }}</td>
                            <td>{{ json_decode($activity->text)->exam }}</td>
                            <td>{{ \App\Exams::where('title', json_decode($activity->text)->exam)->first()->subject->name }}</td>
                            <td>{{ $activity->exam_code }}</td>
                            <td>{{ $activity->created_at }}</td>
                            <td>
                                <a title="Detail" href="/log/quiz-detail/{{$activity->user_id}}/{{$activity->exam_code}}" target="_blank">
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
            $("#log-system").DataTable({
                "aaSorting": [],
            });
        });
    </script>
@stop