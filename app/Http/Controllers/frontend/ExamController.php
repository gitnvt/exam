<?php

namespace App\Http\Controllers\frontend;

use App\Answers;
use App\ExamineeExamcode;
use App\ExamQuestion;
use App\Exams;
use App\Questions;
use App\ResultAnswer;
use App\Results;
use App\Subjects;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Activity;

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
            $result = new Results();
            $result->exam_id = $examId;
            $result->user_id = Auth::user()->id;
            $result->start_time = date('Y-m-d H:i:s');
            $result->time_spent = 0;
            $result->score = 0;
            $result->draft = 1;
            $result->save();
        }else{
            $results_draft->rsAnswers()->delete();
            $result = $results_draft;
        }
        $data['draftResult'] = $result;

        // Get all question for this exam code
        $examCode = ExamineeExamcode::where('user_id', Auth::user()->id)->first()->exam_code;
        $qIds = ExamQuestion::where('exam_id', $examId)->where('exam_code', $examCode)->orWhere('exam_code', null)->pluck('question_id')->toArray();
        $questions = Questions::whereIn('id', $qIds)->get();
//        dd($questions);
//        dd($data['exam']->subject->name);
        /* Log activity */
        Activity::log(
            json_encode([
                'title' => 'Bắt đầu làm bài thi',
                'exam' => $data['exam']->title,
            ]), '',
            [
                'type' => 'quiz',
                'exam_code' => $examCode,
                'action' => 'Start'
            ]
        );

//        dd($questions);
        return view('frontend.exam.quiz', [
            'data' => $data,
            'questions' => $questions
        ]);
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

        /* Log activity */
        Activity::log(
            json_encode([
                'title' => 'Nộp bài thi',
                'exam' => Exams::where('id', $result->exam_id)->first()->title,
            ]), '',
            [
                'type' => 'quiz',
                'exam_code' => ExamineeExamcode::where('user_id', Auth::user()->id)->first()->exam_code,
                'action' => 'end'
            ]
        );

        return redirect('/exam/review/' . $resultId);
    }

    public function getReview($resultId)
    {
        $result = Results::find($resultId);
        return view('frontend.exam.review', [
            'result' => $result,
            'rsAnswers' => $result->rsAnswers()->paginate(10)
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
        if($rs->save()){
            /* Log activity */
            Activity::log(
                json_encode([
                    'title' => 'Trả lời câu hỏi',
                    'question' => $rs->question->content,
                    'answer' => $rs->getAnswer->content
                ]),
                '',
                [
                    'type' => 'quiz',
                    'exam_code' =>ExamineeExamcode::where('user_id', Auth::user()->id)->first()->exam_code,
                    'action' => 'doing'
                ]);
        }
    }
}
