<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,
                                     initial-scale=1.0,
                                     maximum-scale=1.0,
                                     user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CHAT_WITH_SOCKET</title>

    <!-- Styles -->
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
    <style>
        div.well{
            border-width: 3px;
        }
    </style>

    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/angular.js/1.4.6/angular.min.js"></script>
    @yield('script')
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app" ng-app="myApp" ng-controller="myCtrl" >
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/firstPage') }}">
                        CHAT_WITH_SOCKET
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }}<span class="caret"></span>
                                </a>
                                <p id="username" style="display: none;">{{ Auth::user()->name }}</p>
                                <p id="userid" style="display: none;">{{ Auth::user()->id }}</p>
                                <p id="num" style="display: none;"></p>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div ng-controller="btnCtrl">
            <div id="mesTable" class="well mesTable">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>消息</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="mesList" ng-repeat="message in messages">
                        <tr>
                            <td><p><% message.user1 %>请求添加您为好友</p></td>
                            <td>
                                <button class="btn btn-default btn-sm" ng-click="accept(message.user1)">添加</button>
                                <button class="btn btn-danger btn-sm" ng-click="refuse(message.user1)">拒绝</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button class="floatBtn btn btn-default" ng-click="floatBtn()">
                <span class="glyphicon glyphicon-envelope"></span>
                <div id="mesNum" class="floatMes" ng-model="undone">
                    <%undone%>
                </div>
            </button>
        <div>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
