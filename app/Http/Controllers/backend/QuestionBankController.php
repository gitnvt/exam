<?php

namespace App\Http\Controllers\backend;

use App\Answers;
use App\Levels;
use App\Questions;
use App\Scholastic;
use App\Semester;
use App\Subjects;
use App\Terms;
use Faker\Provider\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use MediaUploader;
use Symfony\Component\Console\Question\Question;

class QuestionBankController extends Controller
{
    public function getIndex(){
        $data = Subjects::orderBy('created_at', 'desc')->get();
        return view('backend.question-bank.index', [
            'data' => $data
        ]);
    }
    public function getImport($sub_id = null){
        $subjects = Subjects::orderBy('created_at', 'desc')->get();
        return view('backend.question-bank.import',[
            'subjects' => $subjects,
            'subject_id' => $sub_id,
        ]);
    }

    public function postImport(Request $request){
        // Get subject id
        $subjectId = $request->get('subjectId');
        $fileUploaded = $request->file('questionBank');
        $media = MediaUploader::fromSource($fileUploaded)->toDestination('uploads', 'question-bank')->upload();

//        header('Content-type: text/html; charset=utf-8');
        $file = fopen($media->getAbsolutePath(), 'r');
        while(!feof($file))
        {
            // Remove all blank line
            do{
                $temp = fgets($file);
            }while(empty(trim($temp)));

            // Question text
            $qText = $temp;
            $i=0;
            $choice = [];
            // All answer choice
            while (true){
                $line = fgets($file);
                if(empty(trim($line)))
                    break;
                $choice[$i] = $line;
                $i++;
            }

            // Answer correct
            $correct = fgets($file);
            // Term of question
            $term = fgets($file);
            // Level of question
            $level = fgets($file);

            // Check if term is not exist then create new
            $termRecord = Terms::where('name', $term)->where('subject_id', $subjectId)->first();
            if(!$termRecord){
                $newTerm = new Terms();
                $newTerm->name = $term;
                $newTerm->subject_id = $subjectId;
                $newTerm->save();
                $term_id = $newTerm->id;
            }else{
                $term_id = $termRecord->id;
            }

            // Check if level is not exist then create new
            $levelRecord = Levels::where('name', $level)->first();
            if(!$levelRecord){
                $newLevel = new Levels();
                $newLevel->name = $level;
                $newLevel->save();
                $level_id = $newLevel->id;
            }else
                $level_id = $levelRecord->id;

            // Check exist question
            $question = Questions::where('content', $qText)->where('subject_id', $subjectId)->first();
            if(!$question){
                $newQuestion = new Questions();
                $newQuestion->subject_id = $subjectId;
                $newQuestion->term_id = $term_id;
                $newQuestion->level = $level_id;
                $newQuestion->content = $qText;
                $newQuestion->save();

                for($i=0; $i<count($choice); $i++){
                    $answer = new Answers();
                    $answer->question_id = $newQuestion->id;
                    $answer->content = $choice[$i];
                    if($i == $correct - 1){
                        $answer->is_correct = 1;
                    }else{
                        $answer->is_correct = 0;
                    }
                    $answer->save();
                }
            }
        }
        fclose($file);
        return redirect('/exam');
    }
}
