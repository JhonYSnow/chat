@extends('layouts.app')

@section('script')
    <script src="{{ asset('js/firstPage.js') }}" ></script>
    <script src="{{ asset('js/floatBtn.js') }}"></script>
    <script src="{{ asset('js/chat.js') }}" ></script>
@endsection

@section('content')
    <div class="row" style="padding-left: 10%; padding-right: 10%; padding-top: 2%;">

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="refuse(0)">取消</button>
                        <button id="acceptBtn" type="button" class="btn btn-primary" data-dismiss="modal" ng-click="accept(0)">接受</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModalOk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="">好的</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModalDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabelDel">确认删除？</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button id="acceptBtn" type="button" class="btn btn-primary" data-dismiss="modal" ng-click="delete()">确认</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="well col-sm-6" style="margin-right: 50px;">
            <form class="col-sm-12">
                <input id="search" type="text" class="col-sm-9" style="height: 34px; margin-right: 30px;">
                <button class="btn btn-default col-sm-2" ng-click="search()">
                    <span class="glyphicon glyphicon-search"></span>查找
                </button>
            </form>
            <div id="searchRes" class="col-sm-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>昵称</th>
                        <th>添加</th>
                    </tr>
                    </thead>
                    <tbody id="searchList" ng-repeat="user in users">
                        <tr>
                            <td><% user.id %></td>
                            <td><a><% user.name %></a></td>
                            <td  style="padding: 0px;"><button class="btn btn-default btn-sm" ng-click="add(user.id)">添加</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="well col-sm-5">
            <h2>好友列表<button class="btn btn-default" style="float:right;" onclick="window.location.href = '/allChat?id=' + document.getElementById('userid').innerHTML">群聊</button></h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>昵称</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody ng-model="friends" ng-repeat="friend in friends track by $index">
                    <tr>
                        <td id="id"><% friend.id %></td>
                        <td>
                            <a id="name" ng-model="usernames" ng-click="location(friend.user2)">
                                <% usernames[$index] %>
                            </a>
                        </td>
                        <td  style="padding: 0px;"><button class="btn btn-danger btn-sm" ng-click="setCookie(friend.user2)" data-toggle="modal" data-target="#myModalDel">删除</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection