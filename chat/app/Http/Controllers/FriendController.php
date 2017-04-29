<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;
use App\User;

class FriendController extends Controller
{
    //
    //get
    public function create(Request $request)
    {
        $friend = new Friend;
        $friend1 = new Friend;
        $friend2 = Friend::where(['user1' => $request->user1, 'user2' => $request->user2])->get()->toarray();

        if(count($friend2) == 0){
            $friend->user1 = $request->user1;
            $friend->user2 = $request->user2;

            $friend1->user1 = $request->user2;
            $friend1->user2 = $request->user1;

            if($friend->save() && $friend1->save()){
                return response()->json('OK');
            }else{
                return response()->json('ERROR');
            }
        }else{
            return "不需要重复添加";
        }
    }

    //get
    public function index(){

    }

    //post
    public function store(){

    }

    //get
    public function show($user1){
        $friends = Friend::where(['user1' => $user1])->get()->toarray();

        $usernames = array();
        $num=0;

        foreach ($friends as $friend){
            $usernames[$num] = User::where('id', '=', $friend['user2'])->first()->name;
            $num++;
        }

        return response()->json(['friends' => $friends, 'usernames' => $usernames]);
    }

    //get
    public function edit(){

    }

    //put,patch
    public function update(){

    }

    //delete
    public function delete(Request $request){
        $user1 = $request->user1;
        $user2 = $request->user2;

        Friend::where(['user1' => $user1, 'user2' => $user2])->delete();
        Friend::where(['user2' => $user1, 'user1' => $user2])->delete();

        return "删除成功";
    }
}
