@extends('backend.layout.default')
@section('content')
    <div id="page-inner" class="import-question">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center">Import ngân hàng câu hỏi</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr/>
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <form method="POST" action="/question-bank/import" class="form-horizontal box"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <label for="subjectId">Chọn ngân hàng câu hỏi</label>
                            <select class="form-control" name="questionBankId">
                                <option value="">Chọn ngân hàng</option>
                                @foreach($qBanks as $qb)
                                    <option value="{{ $qb->id }}" }}>{{ $qb->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <label for="subjectId">Chọn môn học</label>
                            <select class="form-control" name="subjectId">
                                <option value="">Chọn môn học</option>
                                @foreach($subjects as $s)
                                    <option value="{{ $s->id }}" {{ ($subject_id == $s->id) ? 'selected' : null }}>{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <label for="questionBank">Tải file câu hỏi</label>
                            <div class="text-center">
                                <div class="upload-group text-center">
                                    <input type="file" name="questionBank" id="file-6"
                                           class="inputfile inputfile-5 hidden"/>
                                    <label for="file-6">
                                        <figure>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17"
                                                 viewBox="0 0 20 17">
                                                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                                            </svg>
                                        </figure>
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center">
                            <button class="btn btn-success" type="submit">
                                Tải lên <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
