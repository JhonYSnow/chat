/**
 * Created by Administrator on 2017/5/3.
 */
var app = angular.module('myApp', [] ,function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');  }
).constant('API_URL', '');

app.controller('myCtrl', function ($scope, $http, API_URL) {
    $scope.showPic = function () {
        $scope.file = document.getElementById('mesPic').files[0];
        if($scope.file) {
            var reader = new FileReader();
            reader.readAsDataURL($scope.file);
            reader.onload = function (e) {
                document.getElementById('imgReview').innerHTML = "<img src='" + this.result + "' style='height: 150px;'/>";
            }
        }
    }
});