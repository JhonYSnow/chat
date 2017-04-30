//angularJs 与 laravel 在 {{}} 上撞车了
var app = angular.module('myApp', [] ,function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');  }
    ).constant('API_URL', '');

app.controller('myCtrl', function($scope, $http, API_URL) {
    $scope.resetMesTab = function () {
        var user1 = document.getElementById('userid').innerHTML;
        $http({
            method: 'GET',
            url: API_URL + '/undoneFriend?user1=' + user1
        }).then(function successCallback(response) {
            console.log(response);

            $scope.messages = response.data;
            $scope.undone = response.data.length;
            if($scope.undone == 0){
                document.getElementById('mesNum').style.display = 'none';
            }

        }, function errorCallback(response) {
            console.log("http error");
        });

    }

    $scope.init = function () {
        var user1 = document.getElementById('userid').innerHTML;

        $http({
            method: 'GET',
            url: API_URL + '/friend/' + user1
        }).then(function successCallback(response) {
            console.log(response);

            $scope.friends = response.data.friends;
            $scope.usernames = response.data.usernames;
        }, function errorCallback(response) {
            console.log("http error");
        });
        $scope.resetMesTab();
    }

    $scope.init();

    $scope.search = function () {
        var name = document.getElementById('search').value;
        $http({
            method: 'GET',
            url: API_URL + '/user/' + name
        }).then(function successCallback(response) {
            $scope.users = response.data;

            console.log($scope.users);

        }, function errorCallback(response) {
            // 请求失败执行代码
            console.log("http error");
        });
    }

    $scope.add = function (user2) {

        $http({
            method: 'GET',
            url: API_URL + '/friend/create?user1=' + document.getElementById('userid').innerHTML +
            '&user2=' + user2
        }).then(function successCallback(response) {
            console.log(response);
            $scope.init();
            // document.cookie = "user1=" + document.getElementById('userid').innerHTML;
            // document.cookie = "user2=" + user2;
            // alert(document.cookie);
        }, function errorCallback(response) {
            console.log("http error");
        });

        webSocketAdd(user2);
    }

    $scope.refuse = function (user2) {
        if(user2 == 0){
            console.log(API_URL + '/friend/create?user1=' + document.getElementById('userid').innerHTML +
                '&user2=' + document.getElementById('myModalLabel').innerHTML.split('@')[0]);
            user2 = document.getElementById('myModalLabel').innerHTML.split('@')[0];
        }else{
            console.log(API_URL + '/friend/create?user1=' + document.getElementById('userid').innerHTML +
                '&user2=' + user2);
        }

        $http({
            method: 'GET',
            url: API_URL + '/deleteFriend?user1=' + user2 +
                "&user2=" + document.getElementById('userid').innerHTML
        }).then(function successCallback(response) {
            console.log(response);
            $scope.init();
            // document.cookie = "user1=" + document.getElementById('userid').innerHTML;
            // document.cookie = "user2=" + user2;
            // alert(document.cookie);
        }, function errorCallback(response) {
            console.log("http error");
        });
    }

    $scope.accept = function (user2) {

        if(user2 == 0){
            console.log(API_URL + '/friend/create?user1=' + document.getElementById('userid').innerHTML +
                '&user2=' + document.getElementById('myModalLabel').innerHTML.split('@')[0]);
            user2 = document.getElementById('myModalLabel').innerHTML.split('@')[0];
        }else{
            console.log(API_URL + '/friend/create?user1=' + document.getElementById('userid').innerHTML +
                '&user2=' + user2);
        }

        $http({
            method: 'GET',
            url: API_URL + '/friend/create?user1=' + document.getElementById('userid').innerHTML +
            '&user2=' + user2
        }).then(function successCallback(response) {
            console.log(response);
            $scope.init();
            // document.cookie = "user1=" + document.getElementById('userid').innerHTML;
            // document.cookie = "user2=" + user2;
            // alert(document.cookie);
        }, function errorCallback(response) {
            console.log("http error");
        });

        webSocketAccept(document.getElementById('myModalLabel').innerHTML.split('@')[0]);

    }

    $scope.delete = function () {
        var user1 = document.getElementById('userid').innerHTML;
        //alert(document.cookie);
        var user2 = document.cookie.split('delId=')[1].split(';')[0];
        console.log(user1 + "  " + document.cookie.split('delId=')[1].split(';')[0]);

        $http({
            method: 'GET',
            url: API_URL + '/deleteFriend?user1=' + user1 + "&user2=" + user2
        }).then(function successCallback(response) {
            console.log(response);
            $scope.init();
            // document.cookie = "user1=" + document.getElementById('userid').innerHTML;
            // document.cookie = "user2=" + user2;
            // alert(document.cookie);
        }, function errorCallback(response) {
            console.log("http error");
        });
    }

    $scope.location = function (user2) {
        window.location.href = '/chat?id='+ user2;
    }

    $scope.setCookie = function (user2) {
        document.cookie = '/chat?delId='+ user2 + ';';
    }

});