@extends('backend.layout.default')
@section('content')
    <div id="create-scholastic">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sinh đề thi</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="/exam/questions">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="method">Hình thức sinh đề</label>
                                    <select class="form-control" name="ExamQuestion[method]">
                                        <option value="{{ \App\Exams::RANDOM }}" {{ ($method == \App\Exams::RANDOM) ? 'selected' : null }}>
                                            Random câu hỏi
                                        </option>
                                        <option value="{{ \App\Exams::MANUAL }}" {{ ($method == \App\Exams::MANUAL) ? 'selected' : null }}>
                                            Chọn thủ công
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="Exam[subject_id]">Môn thi</label>
                                    <select class="form-control" name="ExamQuestion[subject_id]">
                                        <option value="{{ $subjectSelected->id }}">{{ $subjectSelected->name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="Exam[title]">Tên đề thi</label>
                                    <select class="form-control" name="ExamQuestion[exam_id]">
                                        <option value="{{ $exam->id }}"> {{ $exam->title }} </option>
                                    </select>
                                </div>
                            </div>
                            <label><b>Tiêu chí: </b></label>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="method">Số câu hỏi sẵn có</label>
                                    <label class="form-control" type="number">
                                        {{  $subjectSelected->questions()->count() }}
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label for="method">Số câu hỏi cần sinh</label>
                                    <input class="form-control" name="" type="number"/>
                                </div>
                            </div>
                            <!-- Random question -->
                            @if($method == \App\Exams::RANDOM)
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Khối kiến thức</label>
                                        </div>
                                    </div>
                                    @foreach($subjectSelected->terms as $term)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label style="width: 100%; padding: 8px 5px; background: #d1aeae;"
                                                       class="text-center">
                                                    {{  $term->name }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 text-center">
                                                Level
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <label class="text-center">
                                                    Số câu hỏi sẵn có
                                                </label>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <label class="text-center">
                                                    Số câu hỏi cần sinh
                                                </label>
                                            </div>
                                        </div>
                                        @foreach($levels as $level)
                                            <?php
                                            $countQ = \App\Questions::where('subject_id', $subjectSelected->id)
                                                ->where('term_id', $term->id)->where('level', $level->id)->count();
                                            ?>
                                            @if($countQ > 0)
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label style="width: 100%; padding: 8px 5px; background: #eee;"
                                                               class="text-center">
                                                            {{  $level->name }}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-control">{{ $countQ }}</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input class="form-control"
                                                               name="ExamQuestion[{{ $term->id }}][{{ $level->id }}]"
                                                               type="number"/>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            @endif
                            @if($method == \App\Exams::MANUAL)
                                <label> Chọn các câu hỏi cho vào đề </label>
                                <table id="list-questions" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Câu hỏi</th>
                                        <th>Khối kiến thức</th>
                                        <th>Độ khó</th>
                                        <th class="th-action">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subjectSelected->questions as $q)
                                        <tr>
                                            <td>
                                                <div class="checkbox" style="margin: 0;">
                                                    <label style="font-size: 1.1em; padding-left: 0;">
                                                        <input value="{{ $q->id }}" name="ExamQuestion[]" type="checkbox">
                                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ $q->content }}</td>
                                            <td>{{ $q->term->name }}</td>
                                            <td>{{ $q->getLevel->name }}</td>
                                            <td class="user-action text-center">
                                                <a title="Import" href="/question-bank/import/{{$q->id}}" target="_blank">
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
                            @endif
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Sinh đề</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection
@section('js')
    @parent
    <script src="/backend/js/script.js"></script>
    <script>
        $(function () {
            $("#list-questions").DataTable({
                "aaSorting": [],
                "searching": false,
                "ordering": true,
                "paging": false,
            });
        });
    </script>
@stop
