app.controller('permit', function ($scope, permitFactory) {
    $scope.menuShow = {
        'users' : false,
        'permits' : true, 
        'roles' : false
    }
    $scope.paramRequest = {
        'limit': 10,
        'search': '',
        'page': 1
    }
    $scope.permitAdd = {}
    permitFactory.getListPermit($scope)

    $scope.deletePermit = function ($idPermit) {
        permitFactory.deletePermit($idPermit)
            .then(function (response) {
                alert(response.data.message)
                permitFactory.getListPermit($scope)
            })
            .catch(function (err) {
                console.log(err)
            })
    }

    $scope.editPermit = function ($id) {
        permitFactory.permitEdit($id)
            .then(function (response) {
                $scope.permitEdit = response.data.permit
                $('#editPermitModal').modal('show')
            }).catch(function (err) {
                console.log(err)
            })
    }

    $scope.saveEditPermit = function () {
        permitFactory.saveEditPermit($scope.permitEdit.id, {
            'code': $scope.permitEdit.code,
            'display_name': $scope.permitEdit.display_name,
        })
            .then(function (response) {
                console.log(response)
                $('#editPermitModal').modal('hide');
                permitFactory.getListPermit($scope)
            })
            .catch(function (err) {
                console.log('Có lỗi xảy ra')
            })
    }

    $scope.addPermit = function () {
        $('#addPermitModal').modal('show')
    }

    $scope.saveAddPermit = function () {
        permitFactory.saveAddPermit($scope.permitAdd)
            .then(function (response) {
                $('#addPermitModal').modal('hide');
                permitFactory.getListPermit($scope)
            })
            .catch(function (err) {
                alert('Có lỗi xảy ra')
            })
    }

    $scope.changeItemPerPage = function () {
        if ($scope.paramRequest.limit) {
            setTimeout(() => {
                permitFactory.getListPermit($scope)
            }, 1000);
        }
    }


    $scope.filterNameGmail = function () {
        setTimeout(() => {
            $scope.paramRequest.page = 1
            permitFactory.getListPermit($scope)
        }, 1000);

    }
    $scope.changePage = function (p) {
        if (p) {
            setTimeout(() => {
                $scope.paramRequest.page = p
                permitFactory.getListPermit($scope)
            }, 100);
        }
    }
});
