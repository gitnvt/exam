<?php

namespace App\Http\Controllers\backend;

use App\Examcode;
use App\ExamineeExamcode;
use App\ExamQuestion;
use App\Exams;
use App\Questions;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MediaUploader;

class ExamineeController extends Controller
{
    public function getImport()
    {
        return view('backend.examinee.import');
    }

    public function postImport(Request $request)
    {
        ini_set('max_execution_time', 300);

        $fileUploaded = $request->file('examinee');
        $media = MediaUploader::fromSource($fileUploaded)->toDestination('uploads', 'examinee')->upload();

        $file = fopen($media->getAbsolutePath(), 'r');
        while (!feof($file)) {
            // Remove all blank line
            do {
                $temp = fgets($file);
            } while (empty(trim($temp)));

            $username = trim($temp);
            $password = trim(fgets($file));
            $email = $username . '@gmail.com';

            $checkExistUser = User::where('name', $username)->first();
            if (!$checkExistUser) {
                $user = new User();
                $user->email = $email;
                $user->name = $username;
                $user->password = bcrypt($password);
                $user->role = User::EXAMINEE;
                $user->save();
            }
        }

        fclose($file);

        return redirect('/examinee/list');
    }

    public function getList()
    {
        $examinee = User::where('role', User::EXAMINEE)->get();
        return view('backend.examinee.list', [
            'data' => $examinee
        ]);
    }

    public function getGenerateExamCode()
    {
        return view('backend.examinee.generate-exam-code', [
            'exams' => Exams::get()
        ]);
    }

    public function postGenerateExamCode(Request $request)
    {
        $examId = $request->get('ExamId');

        $exam = Exams::where('id', $examId)->first();
        $users = User::where('role', User::EXAMINEE)->get();
        foreach ($users as $u) {
            // Random question for each exam code
            $examCode = 'C' . rand(100, 999);
            $ec = new Examcode();
            $ec->exam_id = $examId;
            $ec->exam_code = $examCode;
            $ec->save();
            foreach ($exam->examMatrix as $em) {
                if ($em->is_random == 0)
                    continue;
                $questions = Questions::where('subject_id', $exam->subject_id)->where('term_id', $em->term_id)
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

            $exec = new ExamineeExamcode();
            $exec->user_id = $u->id;
            $exec->exam_code = $examCode;
            $exec->save();
        }
        return redirect('/examinee/list');
    }

    public function getExamCode($id){
        $user = User::where('id', $id)->first();
        $examCodes = ExamineeExamcode::where('user_id', $id)->pluck('exam_code')->toArray();

        return view('backend.examinee.exam-code', [
            'user' => $user,
            'examCodes' => $examCodes
        ]);
    }

    public function getPreview($examCode){
        $qIds = ExamQuestion::where('exam_code', $examCode)->orWhere('exam_code', null)->pluck('question_id')->toArray();
        $questions = Questions::whereIn('id', $qIds)->get();

        return view('backend.examinee.preview', [
           'questions' => $questions
        ]);
    }
}
