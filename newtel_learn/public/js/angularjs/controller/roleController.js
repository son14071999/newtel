app.controller('roleController', function ($scope, roleFactory) {
    $scope.data = {
        singleRole: 0,
        title: '',
        paramRequest: {
            limit: 10,
            search: '',
            page: 1
        },
        roles: [],
        currentPage: 1,
        itemPerPage: 1,
        pages: 1
    };
    roleFactory.getListRole($scope.data)
    $scope.deleteRole = function ($idRole) {
        roleFactory.deleteRole($idRole)
            .then(function (response) {
                alert(response.data.message)
                roleFactory.getListRole($scope.data)
            })
            .catch(function (err) {
                console.log(err)
            })
    }

    $scope.editRole = function ($id) {
        $scope.data.singleRole = $id;
        $scope.data.title = 'Edit Role'
        $('#formRoleModal').modal('show');
    }

    $scope.addRole = function () {
        $scope.data.singleRole = 0 - Math.abs($scope.data.singleRole) - 1;
        $scope.data.title = 'Add Role'
        $('#formRoleModal').modal('show')
    }


    $scope.changeItemPerPage = function () {
        if ($scope.data.paramRequest.limit) {
            setTimeout(() => {
                roleFactory.getListRole($scope.data)
            }, 1000);
        }
    }


    $scope.filterNameGmail = function () {
        setTimeout(() => {
            $scope.data.paramRequest.page = 1
            roleFactory.getListRole($scope.data)
        }, 1000);

    }
    $scope.changePage = function (p) {
        if (p) {
            setTimeout(() => {
                $scope.data.paramRequest.page = p
                roleFactory.getListRole($scope.data)
            }, 100);
        }
    }


});
