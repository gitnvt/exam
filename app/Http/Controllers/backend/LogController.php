<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function getSystem(){
        $logActivities = Activity::with('user')->where('type', 'system')->orderBy('created_at', 'DESC')->get();
        return view('backend.log.system', [
            'logActivities' => $logActivities
        ]);
    }

    public function getQuiz(){
        $logActivities = Activity::with('user')->where('type', 'quiz')
            ->where('action', '!=', 'doing')->get();
        return view('backend.log.quiz', [
            'logActivities' => $logActivities
        ]);
    }

    public function getQuizDetail($userId, $examCode){
        $logActivities = Activity::with('user')
            ->where('user_id', $userId)->where('exam_code', $examCode)
            ->where('type', 'quiz')->where('action', 'doing')->get();
        return view('backend.log.quiz-detail', [
            'logActivities' => $logActivities
        ]);
    }
}
