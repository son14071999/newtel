app.controller('user', function ($scope, userFactory) {
    $scope.data = {
        singleUser: 0
    };
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
        $scope.data.singleUser = $id
        $('#editUserModal').modal('show')
    }


    $scope.addUser = function () {

        $('#addUserModal').modal('show')
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
