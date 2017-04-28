//angularJs 与 laravel 在 {{}} 上撞车了
var app = angular.module('myApp', [] ,function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');  }
    ).constant('API_URL', 'http://localhost:8000');

app.controller('myCtrl', function($scope, $http, API_URL) {

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
        });
    }

    $scope.add = function (user2) {

        webSocketAdd(user2);
    }

    $scope.refuse = function () {

    }

    $scope.accept = function () {

        webSocketAccept(document.getElementById('myModalLabel').innerHTML.split('请')[0]);

        $http({
            method: 'GET',
            url: API_URL + '/friend/create?user1=' + document.getElementById('userid').innerHTML +
                                    '&user2=' + document.getElementById('myModalLabel').innerHTML
        }).then(function successCallback(response) {
            console.log(response);
            // document.cookie = "user1=" + document.getElementById('userid').innerHTML;
            // document.cookie = "user2=" + user2;
            // alert(document.cookie);
        }, function errorCallback(response) {

        });
    }

});