app.controller('role', function ($scope, roleFactory) {
    localStorage.setItem('menuCurrent', 'role')
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
        roleFactory.roleEdit($id)
            .then(function (response) {
                $scope.roleEdit = response.data.role
                $scope.permits = response.data.permits
                $('#editRoleModal').modal('show')
            }).catch(function (err) {
                console.log(err)
            })
    }

    $scope.saveEditRole = function () {
        roleFactory.saveEditRole($scope.roleEdit.id, {
            'code': $scope.roleEdit.code,
            'name': $scope.roleEdit.name,
        })
            .then(function (response) {
                console.log(response)
                $('#editRoleModal').modal('hide');
                roleFactory.getListRole($scope)
            })
            .catch(function (err) {
                console.log('Có lỗi xảy ra')
            })
    }

    $scope.addRole = function () {
        $('#addRoleModal').modal('show')
    }

    $scope.saveAddRole = function () {
        roleFactory.saveAddRole($scope.roleAdd)
            .then(function (response) {
                $('#addRoleModal').modal('hide');
                roleFactory.getListRole($scope)
            })
            .catch(function (err) {
                alert('Có lỗi xảy ra')
            })
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
