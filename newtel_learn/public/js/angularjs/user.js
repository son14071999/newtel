app.controller('user',  function($scope, $http, convertObjectToString, configURL) {
    console.log(configURL.listUserGet);
    $http(configURL.listUserGet)
    .then(
        function successCallback(response){
            $scope.users = response.data.users.data;
        },
        function errorCallback(response){
            alert('Lỗi r')
        }
    )

    $scope.deleteUser = function($idUser){
        $http(configURL.deleteUser($idUser))
        .then(
            function successCallback(response){
                alert(response.data.message)
            },
            function errorCallback(response){
                alert(response.data.message)
            }
        )
    }



    // $scope.login = function(userLogin){
    //     $scope.errorMessage = ''
    //     $scope.errorStatus = false
    //     userLogin = convertObjectToString(userLogin)
    //     $http(configURL.loginPost(userLogin))
    //     .then(
    //         function successCallback(response){
    //             $scope.errorStatus = false
    //             $scope.errorMessage = ''
    //             window.location.replace(rootUrl+'listUser')
    //         },
    //         function successCallback(response){
    //             $scope.errorStatus = true
    //             $scope.errorMessage = response.data.messageError;
    //         },
    //     )
    // }
});