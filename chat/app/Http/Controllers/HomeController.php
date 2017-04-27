<?php

namespace App\Http\Controllers;

use App\Friend;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function chat(){
        return view('chat');
    }

    public function firstPage(){
        $friends = Friend::where('user1', '=', Auth::user()->id )->get()->toarray();
        $usernames = array();
        $num=0;

        foreach ($friends as $friend){
            $usernames[$num] = User::where('id', '=', $friend['user2'])->first()->name;
            $num++;
        }

        return view('firstPage', compact('friends', 'usernames'));
    }
}
