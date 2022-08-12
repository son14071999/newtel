app.directive('formUser', function (userFactory, departmentFactory) {
    return {
        restrict: 'E',
        templateUrl: rootUrl + "formUser",
        scope: {
            userId: "=",
            title: '=',
            inputData: '='
        },
        link: function (scope, element, attrs) {
            scope.data = {
                userInfo: {},
                roles: [],
                departments: []
            }
            let processData = {
                'getDepartments': () => {
                    departmentFactory.getListDepartment()
                    .then((resp) => {
                        scope.data.departments = resp.data
                        departmentFactory.addPath(scope.data.departments)
                        console.log(scope.data.departments)
                    }).catch((err) => {
                        console.log(err)
                    })
                },
                'getRoles': () => {
                    userFactory.getListRole()
                        .then((response) => {
                            scope.data.roles = response.data.roles
                        }).catch((err) => {
                            alert(err)
                        })
                },
                'getUser': () => {
                    userFactory.userEdit(scope.userId)
                        .then(function (response) {
                            scope.data.userInfo = response.data
                            angular.forEach(scope.data.roles, function (item) {
                                if (item.id == scope.data.userInfo.role_id) {
                                    item.selected = true
                                } else {
                                    item.selected = false
                                }
                            })
                        }).catch(function (err) {
                            console.log(err)
                        })
                },
                'getListUser': () => {
                    userFactory.getListUser()
                }
            }
            scope.$watch('userId', function (newVal, oldVal) {
                if (Number(newVal) <= 0) {
                    scope.data.userInfo = {}
                } else {
                    processData.getUser();
                }
            });
            scope.saveUser = () => {
                if (Number(scope.userId) > 0) {
                    userFactory.saveEditUser(scope.data.userInfo.id, {
                            'name': scope.data.userInfo.name,
                            'email': scope.data.userInfo.email,
                            'role_id': scope.data.userInfo.role_id,
                            'department_id': scope.data.userInfo.department_id
                        })
                        .then(function (response) {
                            $('#formUserModal').modal('hide');
                            userFactory.getListUser(scope.inputData)
                        })
                        .catch(function (err) {
                            console.log('Có lỗi xảy ra')
                        })
                } else {
                    userFactory.saveAddUser(scope.data.userInfo)
                        .then(function (response) {
                            $('#formUserModal').modal('hide');
                            userFactory.getListUser(scope.inputData)
                        })
                        .catch(function (err) {
                            alert('Có lỗi xảy ra')
                        })
                }
            }
            processData.getRoles()
            processData.getDepartments()
        }
    }
})
