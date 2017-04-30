/**
 * Created by Administrator on 2017/4/30.
 */
app.controller('btnCtrl', function($scope, $http, API_URL) {
    var user1 = document.getElementById('userid').innerHTML;

    $scope.resetMesTab = function () {

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

    $scope.resetMesTab();

    var fff = 0;
    $scope.floatBtn = function () {
        if(fff == 0){
            $('#mesTable').show('bounce');
            fff=1;
        }else{
            $('#mesTable').hide('bounce');
            fff=0;
        }
    }
});