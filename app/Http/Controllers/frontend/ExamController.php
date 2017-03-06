<?php

namespace App\Http\Controllers\frontend;

use App\Answers;
use App\Exams;
use App\ResultAnswer;
use App\Results;
use App\Subjects;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function getSubjects(){
        $data['subjects'] = Subjects::with('exams')->get();
        //dd($data['subjects'][0]->exams);
        return view('frontend.exam.subjects', ['data' => $data]);
    }

    public function getQuiz($examId){
        $data['exam'] = Exams::find($examId);
        $results_draft = Results::with('rsAnswers')->where('user_id', Auth::user()->ID)->where('exam_id', $examId)->where('draft', 1)->get();
        foreach ($results_draft as $rs) {
            $rs->rsAnswers()->delete();
            $rs->delete();
        }
        $result = new Results();
        $result->exam_id = $examId;
        $result->user_id = Auth::user()->id;
        $result->start_time = date('Y-m-d H:i:s');
        $result->time_spent = 0;
        $result->score = 0;
        $result->draft = 1;
        $result->save();
        $data['draftResult'] = $result;
        return view('frontend.exam.quiz', ['data' => $data]);
    }

    public function postQuiz($resultId){
        $result = Results::find($resultId);
        $startTime = new \DateTime($result->start_time);
        $endTime = new \DateTime(date('Y-m-d H:i:s'));
//        dd($time_spent->format("%H:%I:%S")$startTime->diff($endTime));
        $result->time_spent = strtotime($startTime->diff($endTime)->format('H:i:s'));
        $result->draft = 0;
        $result->save();
        return redirect('/exam/review/' . $resultId);
    }

    public function getReview($resultId){
        $result = Results::find($resultId);
        return view('frontend.exam.review', [
           'result' => $result
        ]);
    }

    public function getDraftAnswer($resultId, $questionId, $answerId){
        $answerCorrect = Answers::where('question_id', $questionId)->where('is_correct', 1)->first();
        $rs = ResultAnswer::where('result_id', $resultId)->where('question_id', $questionId)->first();
        if(!$rs)
            $rs = new ResultAnswer();
        $rs->result_id = $resultId;
        $rs->question_id = $questionId;
        $rs->answer = $answerId;
        if($answerId == $answerCorrect->id){
            $rs->correct = 1;
        }else{
            $rs->correct = 0;
        }
        $rs->save();
    }
}
