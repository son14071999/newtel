app.controller('departmentController', function ($scope, departmentFactory) {
    $scope.data = {
        singleDepartment: 0,
        title: '',
        departments: [],
        listDepartments: [],
        search: '',
        searchShow: false
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
                return departmentFactory.setDefault($scope.data.departments, department)
            })
            $scope.data.listDepartments = $scope.data.departments
        }).catch((err) => {
            console.log(err)
        })

    $scope.dropDown = (id) => {
        _.map($scope.data.departments, (item) => {
            if(item.id == id){
                item.iconAction = (item.iconAction=='up') ? 'down' : 'up'
                return item
            }
        })
        department = _.find($scope.data.departments, (item) => item.id == id)
        processData.findChild(department)
    }

    let processData = {
        'findChild': (department) => {
            return _.map($scope.data.departments, (item) => {
                if(item.path.includes(department.path+"/")){
                    item.show = (department.iconAction=='down') ? true : false
                    item.iconAction = 'down'
                    return item
                }
            })
        }
    }
    $scope.deleteDepartment = function ($idDepartment) {
        departmentFactory.deleteDepartment($idDepartment)
            .then(function (response) {
                alert(response.data)
                departmentFactory.getListDepartment($scope)
            })
            .catch(function (err) {
                console.log(err)
            })
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

    $scope.searchDepartment = () => {
        $scope.data.listDepartments = departmentFactory.updateDepartments($scope.data.listDepartments)
        $scope.data.departments = $scope.data.listDepartments
        if ($scope.data.search) {
            $scope.data.searchShow = true
            $scope.data.departments = _.filter($scope.data.departments, (department) => {
                if (department.name.includes($scope.data.search)) {
                    return department
                }
            })
        }else{
            $scope.data.searchShow = false
        }
    }


});
