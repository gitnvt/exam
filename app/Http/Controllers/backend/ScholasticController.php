<?php

namespace App\Http\Controllers\backend;

use App\Scholastic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScholasticController extends Controller
{
    //
    public function getIndex(){
        $data = Scholastic::orderBy('created_at', 'desc')->get();
//        dd($data);
        return view('backend.scholastic.index',[
            'data' => $data
        ]);
    }

    public function getCreate(){
        return view('backend.scholastic.create');
    }

    public function postCreate(Request $request){
        $scholastic = new Scholastic($request->get('Scholastic'));
        if($scholastic->save()){
            return redirect('scholastic');
        }else{
        }

        return redirect('scholastic');
    }
}
