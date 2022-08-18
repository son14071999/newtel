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
                        console.log('scope.data.departments: ', scope.data.departments)
                    }).catch((err) => {
                        console.log(err)
                    })
                },
                'getRoles': () => {
                    userFactory.getListRole()
                        .then((response) => {
                            scope.data.roles = response.data.roles
                            console.log(scope.data.roles);
                        }).catch((err) => {
                            alert(err)
                        })
                },
                'getUser': () => {
                    userFactory.userEdit(scope.userId)
                        .then(function (response) {
                            scope.data.userInfo = response.data.user
                            roleIds = response.data.roleIds

                            processData.getDefaultRoles()
                            _.map(scope.data.roles, (role) => {
                                if(roleIds.includes(role.id)){
                                    role.checked = true
                                }
                                return role
                            })
                            console.log(scope.data.roles)
                            

                        }).catch(function (err) {
                            console.log(err)
                        })
                },
                'getListUser': () => {
                    userFactory.getListUser()
                },
                'getDefaultRoles' : () => {
                    _.map(scope.data.roles, (role) => {
                        role.checked = false
                        return role
                    })
                }
            }
            scope.$watch('userId', function (newVal, oldVal) {
                if (Number(newVal) <= 0) {
                    scope.data.userInfo = {}
                    processData.getDefaultRoles()
                } else {
                    processData.getUser()
                }
            });
            scope.saveUser = () => {
                roleIds = _.map(_.filter(scope.data.roles, (role) => role.checked), 'id')
                scope.data.userInfo.role_ids = roleIds
                if (Number(scope.userId) > 0) {
                    userFactory.saveEditUser(scope.data.userInfo.id, scope.data.userInfo)
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
