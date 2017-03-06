<?php

namespace App\Http\Controllers\backend;

use App\Scholastic;
use App\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SemesterController extends Controller
{
    public function getIndex(){
        $data = Semester::orderBy('created_at', 'desc')->get();
//        dd($data[0]->scholastic);
        return view('backend.semester.index',[
            'data' => $data
        ]);
    }

    public function getCreate(){
        $scholastic = Scholastic::orderBy('created_at', 'desc')->get();
        return view('backend.semester.create', [
            'scholastic' => $scholastic
        ]);
    }

    public function postCreate(Request $request){
        $semester = new Semester($request->get('Semester'));
        if($semester->save()){
            return redirect('semester');
        }else{
        }

        return redirect('semester');
    }
}
