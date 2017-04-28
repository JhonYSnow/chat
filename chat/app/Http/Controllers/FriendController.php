<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;

class FriendController extends Controller
{
    //
    //get
    public function create(Request $request)
    {
        $friend = new Friend;

        $friend->user1 = $request->user1;
        $friend->user2 = $request->user2;

        if($friend->save()){
            return response()->json('OK');
        }else{
            return response()->json('ERROR');
        }
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
        //Friend::where()
    }
}
