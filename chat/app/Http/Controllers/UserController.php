<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    //get
    public function create()
    {

    }

    //get
    public function index(){

    }

    //post
    public function store(){

    }

    //get
    public function show($name){
        $users = User::where('name', '=', $name)->orwhere('id', '=', $name)->get()->toarray();

        return response()->json($users);
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
