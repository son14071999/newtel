app.controller('roleController', function ($scope, roleFactory) {
    $scope.data = {
        singleRole: 0
    };

    $scope.permitSearch = ''
    $scope.paramRequest = {
        'limit': 10,
        'search': '',
        'page': 1
    }
    $scope.roleAdd = {}
    roleFactory.getListRole($scope)

    $scope.deleteRole = function ($idRole) {
        roleFactory.deleteRole($idRole)
            .then(function (response) {
                alert(response.data.message)
                roleFactory.getListRole($scope)
            })
            .catch(function (err) {
                console.log(err)
            })
    }

    $scope.editRole = function ($id) {
        $scope.data.singleRole = $id;
        $('#editRoleModal').modal('show');
    }

    $scope.addRole = function () {
        $('#addRoleModal').modal('show')
    }


    $scope.changeItemPerPage = function () {
        if ($scope.paramRequest.limit) {
            setTimeout(() => {
                roleFactory.getListRole($scope)
            }, 1000);
        }
    }


    $scope.filterNameGmail = function () {
        setTimeout(() => {
            $scope.paramRequest.page = 1
            roleFactory.getListRole($scope)
        }, 1000);

    }
    $scope.changePage = function (p) {
        if (p) {
            setTimeout(() => {
                $scope.paramRequest.page = p
                roleFactory.getListRole($scope)
            }, 100);
        }
    }


});
