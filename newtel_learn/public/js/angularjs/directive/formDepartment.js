app.directive('formDepartment', function (departmentFactory) {
    let link = function (scope, element, attrs) {
        scope.data = {
            departmentInfo: {},
            departments: {},
            Listdepartments: {}
        }

        processData = {
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
                        path += '/'+_.find(scope.data.departments, (e) => e.id == parentId).name
                    })
                    department.pathName = path
                    return department
                })
                console.log(scope.data.departments)
            }
        }

        scope.searchDepartment = () => {
            console.log(123456);
            if(!data.searchDepartment){
                scope.data.departments = scope.data.Listdepartments
                _.map(scope.data.departments, (department) => department.includes(data.searchDepartment))
                console.log('---------', scope.data.departments)
            }
        }
        scope.$watch('departmentId', function (newVal, oldVal) {
            scope.data.departmentInfo = {}
            if (!newVal) return false
            processData.getDepartments()
        });


        scope.saveDepartment = function () {
            if(!scope.departmentId){
                let departmentInfo = {
                    'name': scope.data.departmentInfo.name,
                    'parentId': scope.data.parentDepartment.id
                }
                departmentFactory.saveAddDepartment(departmentInfo)
                .then((response) => {
                    $('#formDepartmentModal').modal('hide');
                }).catch((err) => {
                    console.log(err);
                })
            }
        }

        processData.getDepartments();
    };

    return {
        restrict: 'E',
        templateUrl: rootUrl + 'formDepartment',
        scope: {
            departmentId: "=",
            title: '='
        },
        link: link
    }
})
