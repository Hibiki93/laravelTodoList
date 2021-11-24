<?php

namespace App\Http\Controllers;
use App\Models\User;
use Hash;

use Illuminate\Http\Request;
use Validator;
use Auth;

class MainController extends Controller
{
    function index()
    {
        return view('login');
    }

    function registration()
    {
        return view('registration');
    }
    
    function register(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|alphaNum|min:5|max:12',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $res = $user->save();

        if($res){
            return back()->with('success','You Have Registered Successfuly');
        }else{
            return back()->with('fail','Something Wrong');
        }

    }

    function checklogin(Request $request)
    {
        $this->validate($request,[
                'email' => 'required|email',
                'password' => 'required|alphaNum|min:3',
        ]);

        $user = User::where('email','=',$request->email)->first();
        if($user){
            if(Hash::check($request->password,$user->password)){
                $request->session()->put('loginId',$user->id);
                return redirect('/');
            }else{
                return back()->with('fail','Password or ID incorrect.');
            }
        }else{
            return back()->with('fail','This email is not registerd.');
        }

        // $user_data = array(
        //     'email' => $request->get('email'),
        //     'password' => $request->get('password')
        // );

        // if(Auth::attempt($user_data))
        // {
        //     return redirect('login/successlogin');
        // }
        // else
        // {
        //     return back()->with('error','Wrong Login Detail');
        // }
    }

    function successlogin(){
        // return view('home', compact('todolists'));
        return view('successlogin');
    }

    function logout(){
        Auth::logout();
        return reddirect('login');
    }
}
