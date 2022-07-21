app.controller('user', function ($scope, userFactory) {
    $scope.paramRequest = {
        'limit': 10,
        'search': '',
        'page': 1
    }
    $scope.userAdd = {}
    userFactory.getListUser($scope)

    $scope.deleteUser = function ($idUser) {
        userFactory.deleteUser($idUser)
            .then(function (response) {
                alert(response.data.message)
                userFactory.getListUser($scope)
            })
            .catch(function (err) {
                console.log(err)
            })
    }

    $scope.editUser = function ($id) {
        userFactory.userEdit($id)
            .then(function (response) {
                $scope.userEdit = response.data.user
                $scope.roles = response.data.roles
                angular.forEach($scope.roles, function(item){
                    if(item.id == $scope.userEdit.role_id){
                        item.selected = true
                    }else{
                        item.selected = false
                    }
                })
                console.log($scope.roles);
                $('#editModal').modal('show')
            }).catch(function (err) {
                console.log(err)
            })
    }

    $scope.saveEditUser = function () {
        userFactory.saveEditUser($scope.userEdit.id, {
            'name': $scope.userEdit.name,
            'email': $scope.userEdit.email,
            'role_id': $scope.userEdit.role_id,
        })
            .then(function (response) {
                $('#editModal').modal('hide');
                userFactory.getListUser($scope)
            })
            .catch(function (err) {
                console.log('Có lỗi xảy ra')
            })
    }

    $scope.addUser = function () {
        $scope.userAdd = {}
        userFactory.getListRole()
        .then((response) => {
            $scope.roles = response.data.roles
        }).catch((err) => {
            alert(err)
        })
        $('#addUserModal').modal('show')
    }

    $scope.saveAddUser = function () {
        userFactory.saveAddUser($scope.userAdd)
            .then(function (response) {
                $('#addUserModal').modal('hide');
                userFactory.getListUser($scope)
            })
            .catch(function (err) {
                alert('Có lỗi xảy ra')
            })
    }

    $scope.changeItemPerPage = function () {
        if ($scope.paramRequest.limit) {
            setTimeout(() => {
                userFactory.getListUser($scope)
            }, 1000);
        }
    }


    $scope.filterNameGmail = function () {
        setTimeout(() => {
            $scope.paramRequest.page = 1
            userFactory.getListUser($scope)
        }, 1000);

    }
    $scope.changePage = function (p) {
        if (p) {
            setTimeout(() => {
                $scope.paramRequest.page = p
                userFactory.getListUser($scope)
            }, 100);
        }
    }
});
