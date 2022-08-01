app.controller('departmentController', function ($scope, departmentFactory) {
    $scope.data = {
        singleDepartment: 0,
        title: '',
        departments: []
    };

    $scope.paramRequest = {
        'limit': 10,
        'search': '',
        'page': 1
    }
    $scope.departmentAdd = {}
    departmentFactory.getListDepartment()
    .then((resp) => {
        $scope.data.departments = resp.data
        _.map($scope.data.departments, (department) => {
            department.paddingLeft = department.path.split('/').length*20 + "px"
            return department
        })
        console.log('resp1: ', $scope.data.departments);
    }).catch((err) => {
        console.log(err)
    })

    $scope.deleteDepartment = function ($idDepartment) {
        // departmentFactory.deleteDepartment($idDepartment)
        //     .then(function (response) {
        //         alert(response.data.message)
        //         // departmentFactory.getListDepartment($scope)
        //     })
        //     .catch(function (err) {
        //         console.log(err)
        //     })
    }

    $scope.editDepartment = function ($id) {
        $scope.data.singleDepartment = $id;
        $scope.data.title = 'Edit Department'
        $('#formDepartmentModal').modal('show');
    }

    $scope.addDepartment = function () {
        $scope.data.singleDepartment = 0;
        $scope.data.title = 'Add Department'
        $('#formDepartmentModal').modal('show')
    }


    $scope.changeItemPerPage = function () {
        if ($scope.paramRequest.limit) {
            setTimeout(() => {
                // departmentFactory.getListDepartment($scope)
            }, 1000);
        }
    }


    $scope.filterNameGmail = function () {
        setTimeout(() => {
            $scope.paramRequest.page = 1
            // departmentFactory.getListDepartment($scope)
        }, 1000);

    }

    $scope.changePage = function (p) {
        if (p) {
            setTimeout(() => {
                $scope.paramRequest.page = p
                // departmentFactory.getListDepartment($scope)
            }, 100);
        }
    }


});
