@extends('frontend.layout.default')
@section('content')
    <link rel="stylesheet" type="text/css" href="/frontend/css/quiz.css">
    <h4>Danh sách các đề môn học có sắn đề thi:</h4>
    <ul class="nav navbar">
        @foreach($data['subjects'] as $sb)
            @if(count($sb->exams))
                <li><a href="/exam/quiz/{{$sb->exams[rand(0, count($sb->exams)-1)]->id}}">{{$sb->name}}</a></li>
            @endif
        @endforeach
    </ul>
@endsection