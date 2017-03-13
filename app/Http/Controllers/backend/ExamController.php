<?php

namespace App\Http\Controllers\backend;

use App\ExamMatrix;
use App\ExamQuestion;
use App\Exams;
use App\Levels;
use App\Questions;
use App\Subjects;
use App\Terms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Console\Question\Question;

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
//        $method = $post['Exam']['method'];
//        $post['Exam']['start_time'] = date('Y-m-d H:i:s', strtotime($post['Exam']['start_time']));
//        $post['Exam']['end_time'] = date('Y-m-d H:i:s', strtotime($post['Exam']['end_time']));
        $post['Exam']['status'] = 1;
        $exam = new Exams($post['Exam']);
        if($exam->save()){
//            return redirect('/exam/questions/' . $exam->id . '/' . $exam->subject_id . '/'.$method);
            return redirect('/exam/matrix/' . $exam->id);
        }else{
            dd("error");
        }
    }

//    public function getQuestions($examId, $subjectId, $method){
//        $subjects = Subjects::get();
//        $subjectSelected = Subjects::where('id', $subjectId)->first();
//
//        return view('backend.exam.question',[
//            'exam' => Exams::where('id', $examId)->first(),
//            'levels' => Levels::get(),
//            'subjects' => $subjects,
//            'subjectSelected' => $subjectSelected,
//            'method' => $method
//            ]);
//    }
//
//    public function postQuestions(Request $request){
//        $dataPost = $request->get('ExamQuestion');
//        $examId = $dataPost['exam_id'];
//        $subjectId = $dataPost['subject_id'];
//        $method = $dataPost['method'];
//        unset($dataPost['exam_id']);
//        unset($dataPost['subject_id']);
//        unset($dataPost['method']);
//
//        if($method == Exams::RANDOM){
//            foreach ($dataPost as $termId => $val){
//                foreach ($val as $level => $quantity){
//                    $questions = Questions::where('subject_id', $subjectId)->where('term_id', $termId)
//                        ->where('level', $level)->get()->toArray();
//                    for($i=0; $i<$quantity; $i++){
//                        $index = rand(0, count($questions) - 1);
//                        $exq = new ExamQuestion();
//                        $exq->exam_id = $examId;
//                        $exq->question_id = $questions[$index]['id'];
//                        $exq->save();
//                        array_splice($questions, $index, 1);
//                    }
//                }
//            }
//        }
//
//        if($method == Exams::MANUAL){
//            foreach ($dataPost as $d){
//                $exq = new ExamQuestion();
//                $exq->exam_id = $examId;
//                $exq->question_id = $d;
//                $exq->save();
//            }
//        }
//        return redirect('/exam');
//    }

    public function getMatrix($examId){
        $exam = Exams::where('id', $examId)->first();
        $subject = Subjects::where('id', $exam->subject_id)->first();
        $levelIds = Questions::where('subject_id', $exam->subject_id)->distinct('level')->pluck('level');
        $levels = Levels::whereIn('id', $levelIds)->get();
        return view('backend.exam.matrix', [
            'exam' => $exam,
            'levels' => $levels,
            'subject' => $subject
        ]);
    }

    public function postMatrix(Request $request, $examId){
        $dataPost = $request->get('ExamMatrix');
        foreach ($dataPost as $termId => $levelData){
            foreach ($levelData as $lvId => $quantity){
                if($quantity > 0){
                    $em = new ExamMatrix();
                    $em->exam_id = $examId;
                    $em->term_id = $termId;
                    $em->level_id = $lvId;
                    $em->quantity = $quantity;
                    $em->save();
                }
            }
        }
        return redirect('/exam/method/' . $examId);
    }

    public function getMethod($examId){
        $exam = Exams::where('id', $examId)->first();
        $subject = Subjects::where('id', $exam->subject_id)->first();
        $levelIds = Questions::where('subject_id', $exam->subject_id)->distinct('level')->pluck('level');
        $levels = Levels::whereIn('id', $levelIds)->get();
        return view('backend.exam.method', [
            'exam' => $exam,
            'levels' => $levels,
            'subject' => $subject
        ]);
    }

    public function postMethod(Request $request, $examId){
        $exam = Exams::where('id', $examId)->first();
        $random = $request->get('Random');
        $manual = $request->get('Manual');
//        dd($random);
//        dd($manual);
        if($random){
            foreach ($random as $termId => $data){
                foreach ($data as $lvId => $val){
                    if($val){
                        $dt = explode('-', $val);
                        $bankId = $dt[0];
                        $quantity = $dt[1];

                        $questions = Questions::where('subject_id', $exam->subject->id)->where('term_id', $termId)
                            ->where('level', $lvId)->where('bank_id', $bankId)->get()->toArray();
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
        }
        if($manual){
            foreach ($manual as $m){
                $examQ = new ExamQuestion();
                $examQ->exam_id = $examId;
                $examQ->question_id = $m;
                $examQ->save();
            }
        }

        return redirect('/exam');
    }

    public function getQuestions($examMatrixId, $bankId){
        $examMatrix = ExamMatrix::where('id', $examMatrixId)->first();
        $questions = Questions::where('subject_id', $examMatrix->exam->subject->id)
            ->where('term_id', $examMatrix->term_id)->where('level', $examMatrix->level_id)
            ->where('bank_id', $bankId)->with('answers')->get();
        return json_encode($questions);
    }
}
