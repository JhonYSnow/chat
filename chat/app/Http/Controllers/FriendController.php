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
        $friend2 = Friend::where(['user1' => $request->user1, 'user2' => $request->user2])->get()->toarray();

        if(count($friend2) == 0){
            $friend->user1 = $request->user1;
            $friend->user2 = $request->user2;

            if($friend->save()){
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

    //找到未处理的请求
    public function undone(Request $request){
        $friends1 = Friend::where(['user2' => $request->user1])->get()->toarray();
        $friends2 = Friend::where(['user1' => $request->user1])->get()->toarray();

        $friends = array();
        $num = 0;
        for($i = 0; $i<count($friends1); $i++){
            $flag = 0;
            for($j = 0; $j<count($friends2); $j++){
                if($friends1[$i]['user1'] == $friends2[$j]['user2']){
                    $flag = 1;
                }
            }
            if($flag == 0)
                $friends[$num] = $friends1[$i];
        }

        return $friends;
    }
}
