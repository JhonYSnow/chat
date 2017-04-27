<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Messages;
use App\User;

class MessageController extends Controller
{
    //
    //'id', 'mes', 'user1','user2','mes_type','send_time'

    //get
    public function create(Request $request)
    {
//        $message = new Messages;
//        $message->mes = $request->mes;
//        $message->user1 = User::where('email', '=', Auth::user()->email) ->first()->id;
//        $message->user2 = 2;
//        $message->mes_type = 1;
//        $message->send_time = "2017-02-02";
//
//        if ($message->save()) {
//            redirect()->back()->withInput()->withErrors('删除成功！');
//        } else {
//            alert('发送失败');
//        }
    }

    //get
    public function index(){

    }

    //post
    public function store(){

    }

    //get
    public function show(){

    }

    //get
    public function edit(){

    }

    //put,patch
    public function update(){

    }

    //delete
    public function destroy(){

    }
}
