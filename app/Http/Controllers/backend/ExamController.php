<?php

namespace App\Http\Controllers\backend;

use App\ExamQuestion;
use App\Exams;
use App\Levels;
use App\Questions;
use App\Subjects;
use App\Terms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    public function getIndex(){
        $data = Exams::orderBy('created_at', 'desc')->get();
        return view('backend.exam.index', [
            'data' => $data
        ]);
    }

    public function getCreate(){
        $subjects = Subjects::get();
        return view('backend.exam.create', [
            'subjects' => $subjects
        ]);
    }

    public function postCreate(Request $request){
        $post = $request->all();
        $method = $post['Exam']['method'];
        $post['Exam']['start_time'] = date('Y-m-d H:i:s', strtotime($post['Exam']['start_time']));
        $post['Exam']['end_time'] = date('Y-m-d H:i:s', strtotime($post['Exam']['end_time']));
        $exam = new Exams($post['Exam']);
        if($exam->save()){
            return redirect('/exam/questions/' . $exam->id . '/' . $exam->subject_id . '/'.$method);
        }else{
            dd("error");
        }
    }

    public function getQuestions($examId, $subjectId, $method){
        $subjects = Subjects::get();
        $subjectSelected = Subjects::where('id', $subjectId)->first();

        return view('backend.exam.question',[
            'exam' => Exams::where('id', $examId)->first(),
            'levels' => Levels::get(),
            'subjects' => $subjects,
            'subjectSelected' => $subjectSelected,
            'method' => $method
            ]);
    }

    public function postQuestions(Request $request){
        $dataPost = $request->get('ExamQuestion');
        $examId = $dataPost['exam_id'];
        $subjectId = $dataPost['subject_id'];
        $method = $dataPost['method'];
        unset($dataPost['exam_id']);
        unset($dataPost['subject_id']);
        unset($dataPost['method']);

        if($method == Exams::RANDOM){
            foreach ($dataPost as $termId => $val){
                foreach ($val as $level => $quantity){
                    $questions = Questions::where('subject_id', $subjectId)->where('term_id', $termId)
                        ->where('level', $level)->get()->toArray();
                    for($i=0; $i<$quantity; $i++){
                        $index = rand(0, count($questions) - 1);
                        $exq = new ExamQuestion();
                        $exq->exam_id = $examId;
                        $exq->question_id = $questions[$index]['id'];
                        $exq->save();
                        array_splice($questions, $index, 1);
                    }
                }
            }
        }

        if($method == Exams::MANUAL){
            foreach ($dataPost as $d){
                $exq = new ExamQuestion();
                $exq->exam_id = $examId;
                $exq->question_id = $d;
                $exq->save();
            }
        }
        return redirect('/exam');
    }
}
