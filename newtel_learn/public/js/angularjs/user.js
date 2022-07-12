app.controller('user',  function($scope, $http) {
    $http.get(rootUrl+"api/listUser")
    .then(
        function successCallback(response){
            $scope.users = response.data.users.data;
            $scope.itemPerPage = response.data.itemPerPage
        },
        function errorCallback(response){
            alert('Lỗi r')
        }
    )

    $scope.deleteUser = function($idUser){
        $http.get(rootUrl+'api/deleteListUser/'+$idUser)
        .then(
            function successCallback(response){
                alert(response.data.message)
                location.reload()
            },
            function errorCallback(response){
                alert(response.data.message)
            }
        )
    }


    $scope.editUser = function($id){
        $http.get(rootUrl+'api/showUser/'+$id)
        .then(function(response){
            $scope.userEdit = response.data.user
            $('#editModal').modal('show')
        }).catch(function(err){
            console.log(err)
        })
    }

    $scope.saveEditUser = function(){
        console.log($scope.userEdit.id);
        $http.post(rootUrl+"api/editUser/"+$scope.userEdit.id, {
            'name' : $scope.userEdit.name,
            'email' : $scope.userEdit.email,
        })
        .then(function(response){
            $('#editModal').modal('hide');
            location.reload();
        })
        .catch(function(err){
            alert('Có lỗi xảy ra')
        })
    }


    $scope.addUser = function() {
        $('#addUserModal').modal('show')
    }


    $scope.saveAddUser = function(){
        console.log($scope.userAdd);
        $http.post(rootUrl+"api/addUser", $scope.userAdd)
        .then(function(response){
            $('#addUserModal').modal('hide');
            location.reload();
        })
        .catch(function(err){
            alert('Có lỗi xảy ra')
        })
    }

    $scope.changeItemPerPage = function(){
        var url = window.location.href;
        let result = url.match(/limit=[0-9]+/i);
        if(result){
            let pattern = /(.*limit=)([0-9]+)(.*)/i;
            url = url.replace(pattern, "$1"+$scope.itemPerPage+"$3");
        }else{
            if (url.indexOf('?') > -1){
            url += '&limit='+$scope.itemPerPage
            }else{
            url += '?param='+$scope.itemPerPage
            }
        }
        window.location.href = url;
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
