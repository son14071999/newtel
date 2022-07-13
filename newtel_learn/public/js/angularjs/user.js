app.controller('user',  function($scope, $http, functionHandle) {
    $http.get(rootUrl+"api/listUser"+window.location.search)
    .then(
        function successCallback(response){
            $scope.users = response.data.users;
            $scope.itemPerPage = response.data.itemPerPage
            $scope.pages = Array.from({length: response.data.pages}, (_, i) => i + 1)
            $scope.currentPage = response.data.page
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
        if($scope.itemPerPage){
            setTimeout(() => {     
                url = functionHandle.insertUrl('limit',$scope.itemPerPage)
                window.location.href = url;
            }, 1000);
        }
    }


    $scope.search = function (){
        $scope.textSearch = $scope.textSearch ?? ''
        setTimeout(() => {     
            url = functionHandle.insertUrl('search',$scope.textSearch)
            window.location.href = url;
        }, 1000);
        
    }
    $scope.changePage = function(p){
        console.log(p);
        if(p){
            setTimeout(() => {     
                url = functionHandle.insertUrl('page',p)
                window.location.href = url;
            }, 100);
        }
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
