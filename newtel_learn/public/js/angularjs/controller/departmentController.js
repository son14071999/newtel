app.controller('departmentController', function ($scope, departmentFactory) {
    $scope.data = {
        singleDepartment: 0,
        title: '',
        departments: [],
        listDepartments: [],
        search: ''
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
                department.paddingLeft = department.path.split('/').length * 20 + "px"
                department.hasChild = processData.hasChild(department.id)
                department.iconAction = 'down'
                department.show = true
                return department
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
        'hasChild': (id) => {
            for (let i = 0; i < $scope.data.departments.length; i++) {
                if ($scope.data.departments[i].parent_id == id) {
                    return true
                }
            }
            return false
        },
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
        $scope.data.departments = $scope.data.listDepartments
        if ($scope.data.search) {
            $scope.data.departments = _.filter($scope.data.departments, (department) => {
                if (department.name.includes($scope.data.search)) {
                    return department
                }
            })
        }
    }


});
