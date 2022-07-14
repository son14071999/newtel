app.controller('user', function ($scope, $http, functionHandle) {
    $scope.limit = 10
    $scope.search = ''
    $scope.page = 1
    functionHandle.getListUser($scope, $http)

    $scope.deleteUser = function($idUser){
        $http.get(rootUrl+'api/deleteListUser/'+$idUser, functionHandle.header)
        .then(function(response){
            alert(response.data.message)
            functionHandle.getListUser($scope, $http)
        })
        .catch(function(err){
            console.log(err)
        })
    }

    $scope.editUser = function ($id) {
        console.log($('#editModal'));
        $http.get(rootUrl + 'api/showUser/' + $id, functionHandle.header)
            .then(function (response) {
                $scope.userEdit = response.data.user
                $('#editModal').modal('show')
            }).catch(function (err) {
                console.log(err)
            })
    }

    $scope.saveEditUser = function () {
        $http.post(rootUrl + "api/editUser/" + $scope.userEdit.id, {
            'name': $scope.userEdit.name,
            'email': $scope.userEdit.email,
        }, functionHandle.header)
            .then(function (response) {
                $('#editModal').modal('hide');
                functionHandle.getListUser($scope, $http)
            })
            .catch(function (err) {
                console.log('Có lỗi xảy ra')
            })
    }

    $scope.addUser = function () {
        $('#addUserModal').modal('show')
    }

    $scope.saveAddUser = function () {
        console.log($scope.userAdd);
        $http.post(rootUrl + "api/addUser", $scope.userAdd,functionHandle.header)
            .then(function (response) {
                $('#addUserModal').modal('hide');
                functionHandle.getListUser($scope, $http)
            })
            .catch(function (err) {
                alert('Có lỗi xảy ra')
            })
    }

    $scope.changeItemPerPage = function () {
        if ($scope.limit) {
            setTimeout(() => {
                functionHandle.getListUser($scope, $http)
            }, 1000);
        }
    }


    $scope.filterNameGmail = function () {
        setTimeout(() => {
            $scope.page = 1
            functionHandle.getListUser($scope, $http)
        }, 1000);

    }
    $scope.changePage = function (p) {
        if (p) {
            setTimeout(() => {
                $scope.page = p
                functionHandle.getListUser($scope, $http)
            }, 100);
        }
    }

    $scope.logout = function() {
        $http.post(rootUrl+'api/logout', {},functionHandle.header)
        .then((response) => {
            window.location.replace(rootUrl+'login')
        }).catch((err) => {
            alert('Logout thất bại')
        })
    }
});
    