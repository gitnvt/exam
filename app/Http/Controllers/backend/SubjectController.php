<?php

namespace App\Http\Controllers\backend;

use App\Scholastic;
use App\Semester;
use App\Subjects;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    public function getIndex(){
        $data = Subjects::orderBy('created_at', 'desc')->get();
        return view('backend.subject.index', [
            'data' => $data
        ]);
    }

    public function getCreate(){
        $scholastic = Scholastic::orderBy('created_at', 'desc')->get();
        $semester = Semester::orderBy('created_at', 'desc')->get();
        return view('backend.subject.create', [
            'scholastic' => $scholastic,
            'semester' => $semester
        ]);
    }

    public function postCreate(Request $request){
        $subject = new Subjects($request->get('Subject'));
        if($subject->save()){
            return redirect('subject');
        }else{
        }

        return redirect('subject');
    }
}
