app.controller('userController', function ($scope, userFactory) {
    $scope.data = {
        singleUser: 0,
        title: '',
        paramRequest: {
            limit: 10,
            search: '',
            page: 1
        },
        pages: 1,
        currentPage: 1,
        itemPerPage: 1,
        users: []
    };

    userFactory.getListUser($scope.data)

    $scope.deleteUser = function ($idUser) {
        userFactory.deleteUser($idUser)
            .then(function (response) {
                alert(response.data.message)
                userFactory.getListUser($scope.data)
            })
            .catch(function (err) {
                console.log(err)
            })
    }

    $scope.editUser = function ($id) {
        $scope.data.singleUser = $id
        $scope.data.title = 'Edit User'
        $('#formUserModal').modal('show')
    }


    $scope.addUser = function () {
        $scope.data.singleUser = 0 - Math.abs($scope.data.singleUser) - 1
        $scope.data.title = 'Add User'
        $('#formUserModal').modal('show')
    }


    $scope.changeItemPerPage = function () {
        if ($scope.data.paramRequest.limit) {
            setTimeout(() => {
                userFactory.getListUser($scope.data)
            }, 1000);
        }
    }


    $scope.filterNameGmail = function () {
        setTimeout(() => {
            $scope.data.paramRequest.page = 1
            userFactory.getListUser($scope.data)
        }, 1000);

    }
    $scope.changePage = function (p) {
        if (p) {
            setTimeout(() => {
                $scope.data.paramRequest.page = p
                userFactory.getListUser($scope.data)
            }, 100);
        }
    }
});
