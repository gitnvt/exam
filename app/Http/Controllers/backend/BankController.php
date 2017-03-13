<?php

namespace App\Http\Controllers\backend;

use App\QuestionBanks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankController extends Controller
{
    public function getIndex(){
        $data = QuestionBanks::orderBy('created_at', 'desc')->get();
        return view('backend.bank.index', [
            'data' => $data
        ]);
    }

    public function getCreate(){
        return view('backend.bank.create');
    }

    public function postCreate(Request $request){
        $qBank = new QuestionBanks($request->get('QuestionBank'));
        if($qBank->save()){
            return redirect('bank');
        }else{
        }

        return redirect('bank');
    }
}
