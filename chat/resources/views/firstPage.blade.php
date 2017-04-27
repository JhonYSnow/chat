@extends('layouts.app')

@section('content')
    <div class="row" style="padding-left: 10%; padding-right: 10%; padding-top: 2%;">
        <div class="well col-sm-6" style="margin-right: 50px;">
            <div class="col-sm-12">
                <input id="search" type="text" class="col-sm-9" style="height: 34px; margin-right: 30px;">
                <button class="btn btn-default col-sm-2"><span class="glyphicon glyphicon-search"></span>查找</button>
            </div>
            <div id="searchRes" class="col-sm-12">

            </div>
        </div>
        <div class="well col-sm-5">
            <h2>好友列表</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            id
                        </th>
                        <th>
                            头像
                        </th>
                        <th>
                            昵称
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($friends as $indexKey => $friend)
                    <tr>
                        <td id="id">
                            {{ $friend['user2'] }}
                        </td>
                        <td>
asd
                        </td>
                        <td>
                            <a id="name" onclick="window.location.href = '/chat?id={{ $friend['user2'] }}'">{{ $usernames[$indexKey] }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection