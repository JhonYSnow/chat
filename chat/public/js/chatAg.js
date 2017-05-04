/**
 * Created by Administrator on 2017/5/3.
 */
var app = angular.module('myApp', [] ,function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');  }
).constant('API_URL', '');

app.controller('myCtrl', function ($scope, $http, API_URL) {

});