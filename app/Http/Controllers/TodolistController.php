<?php

namespace App\Http\Controllers;

use App\Models\User;
use Session;

use App\Models\todolist;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    public function index()
    {
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id','=',Session::get('loginId'))->first();
            $todolists = Todolist::all();
            return view('home' , compact('todolists'));
        }else{
            return redirect('login');
        }
    }

    public function store(Request $request)
    {
        $data = $request -> validate([
            'content' => 'required'
        ]);

        Todolist::create($data);
        return back();
    }
 
    public function destroy(todolist $todolist)
    {
        $todolist -> delete();
        return back();
    }
}
