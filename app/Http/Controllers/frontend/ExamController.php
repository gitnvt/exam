<?php

namespace App\Http\Controllers\frontend;

use App\Answers;
use App\ExamQuestion;
use App\Exams;
use App\Questions;
use App\ResultAnswer;
use App\Results;
use App\Subjects;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function getSubjects()
    {
        $data['subjects'] = Subjects::with('exams')->get();
        //dd($data['subjects'][0]->exams);
        return view('frontend.exam.subjects', ['data' => $data]);
    }

    public function getQuiz($examId)
    {
        $data['exam'] = Exams::find($examId);

        $results_draft = Results::with('rsAnswers')->where('user_id', Auth::user()->id)->where('exam_id', $examId)->where('draft', 1)->first();
        if(!$results_draft){
            // Random question for each exam code
            $examCode = 'C' . rand(100, 999);
            foreach ($data['exam']->examMatrix as $em) {
                if($em->is_random == 0)
                    continue;
                $questions = Questions::where('subject_id', $data['exam']->subject_id)->where('term_id', $em->term_id)
                    ->where('level', $em->level_id)->where('bank_id', $em->bank_id)->get()->toArray();
                for ($i = 0; $i < $em->quantity; $i++) {
                    $index = rand(0, count($questions) - 1);
                    $exq = new ExamQuestion();
                    $exq->exam_id = $examId;
                    $exq->question_id = $questions[$index]['id'];
                    $exq->exam_code = $examCode;
                    $exq->save();
                    array_splice($questions, $index, 1);
                }
            }

            $result = new Results();
            $result->exam_id = $examId;
            $result->user_id = Auth::user()->id;
            $result->start_time = date('Y-m-d H:i:s');
            $result->time_spent = 0;
            $result->score = 0;
            $result->exam_code = $examCode;
            $result->draft = 1;
            $result->save();
        }else{
            $results_draft->rsAnswers()->delete();
            $result = $results_draft;
            $examCode = $result->exam_code;
        }
        $data['draftResult'] = $result;

        // Get all question for this exam code
        $ex = ExamQuestion::where('exam_id', $examId)->where('exam_code', $examCode)->orWhere('exam_code', null)->pluck('question_id');

        return view('frontend.exam.quiz', ['data' => $data]);
    }

    public function postQuiz($resultId)
    {
        $result = Results::find($resultId);
        $startTime = new \DateTime($result->start_time);
        $endTime = new \DateTime(date('Y-m-d H:i:s'));
//        dd($time_spent->format("%H:%I:%S")$startTime->diff($endTime));
        $result->time_spent = strtotime($startTime->diff($endTime)->format('H:i:s'));
        $result->draft = 0;
        $result->save();
        return redirect('/exam/review/' . $resultId);
    }

    public function getReview($resultId)
    {
        $result = Results::find($resultId);
        return view('frontend.exam.review', [
            'result' => $result
        ]);
    }

    public function getDraftAnswer($resultId, $questionId, $answerId)
    {
        $answerCorrect = Answers::where('question_id', $questionId)->where('is_correct', 1)->first();
        $rs = ResultAnswer::where('result_id', $resultId)->where('question_id', $questionId)->first();
        if (!$rs)
            $rs = new ResultAnswer();
        $rs->result_id = $resultId;
        $rs->question_id = $questionId;
        $rs->answer = $answerId;
        if ($answerId == $answerCorrect->id) {
            $rs->correct = 1;
        } else {
            $rs->correct = 0;
        }
        $rs->save();
    }
}
