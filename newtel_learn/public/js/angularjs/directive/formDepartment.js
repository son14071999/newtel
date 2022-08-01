app.directive('formDepartment', function (departmentFactory) {
    let link = function (scope, element, attrs) {
        scope.data = {
            departmentInfo: {},
            departments: {},
            Listdepartments: {}
        }

        processData = {
            getDepartmentInfo: () => {
                departmentFactory.departmentInfo(scope.departmentId)
                .then((resp) => {
                    scope.data.departmentInfo = resp.data
                    _.map(scope.data.departments, (department) => {
                        if(department.id == scope.data.departmentInfo.parent_id){
                            department.selected = true
                        }else{
                            department.selected = false
                        }
                        return department
                    })
                }).catch((err) => {
                    console.log(err);
                })
            },
            getDepartments: () => {
                departmentFactory.getListDepartment()
                    .then((resp) => {
                        scope.data.departments = resp.data
                        processData.addPath()
                        scope.data.Listdepartments = scope.data.departments
                    }).catch((err) => {
                        console.log('err: ', err);
                    })
            },
            addPath: () => {
                _.map(scope.data.departments, (department) => {
                    let path = ''
                    let parents = department.path.split('/')
                    _.each(parents, (parentId) => {
                        path += '/' + _.find(scope.data.departments, (e) => e.id == parentId).name
                    })
                    department.pathName = path
                    return department
                })
            }
        }

        scope.searchDepartment = () => {
            if (scope.data.searchDepartment) {
                scope.data.departments = scope.data.Listdepartments
                scope.data.departments = _.filter(scope.data.departments, (department) => {
                    if(department.name.includes(scope.data.searchDepartment)){
                        return department
                    }
                })
            }
        }
        scope.$watch('departmentId', function (newVal, oldVal) {
            scope.data.departmentInfo = {}
            processData.getDepartments()
            if (!newVal) return false
            processData.getDepartmentInfo()
        });


        scope.saveDepartment = function () {
            if (!scope.departmentId) {
                let departmentInfo = {
                    'name': scope.data.departmentInfo.name,
                    'parentId': scope.data.departmentInfo.parent_id
                }
                departmentFactory.saveAddDepartment(departmentInfo)
                    .then((response) => {
                        $('#formDepartmentModal').modal('hide');

                    }).catch((err) => {
                        console.log(err);
                    })
            }else{
                let departmentInfo = {
                    'name': scope.data.departmentInfo.name,
                    'parentId': scope.data.departmentInfo.parent_id
                }
                departmentFactory.saveEditDepartment(scope.departmentId, departmentInfo)
                .then((resp) => {
                    $('#formDepartmentModal').modal('hide');
                }).catch((err) => {
                    console.log(err)
                })
            }
            processData.getDepartments();
        }

        processData.getDepartments();

    };

    return {
        restrict: 'E',
        templateUrl: rootUrl + 'formDepartment',
        scope: {
            departmentId: "=",
            title: '=',
        },
        link: link
    }
})
