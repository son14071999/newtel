app.directive('editUser', function (userFactory) {
    return {
        restrict: 'E',
        templateUrl: rootUrl + "editUser",
        scope: {
            userId: "="
        },
        link: function (scope, element, attrs) {
            scope.data = {
                userEdit: {},
                roles: []
            }
            let processData = {
                'getUser': () => {
                    userFactory.userEdit(scope.userId)
                        .then(function (response) {
                            scope.data.userEdit = response.data.user
                            scope.data.roles = response.data.roles
                            angular.forEach(scope.data.roles, function (item) {
                                if (item.id == scope.data.userEdit.role_id) {
                                    item.selected = true
                                } else {
                                    item.selected = false
                                }
                            })
                        }).catch(function (err) {
                            console.log(err)
                        })
                }
            }
            scope.$watch('userId', function (newVal, oldVal) {
                if (!newVal) return false;
                processData.getUser();
            });
            scope.saveEditUser = () => {
                userFactory.saveEditUser(scope.data.userEdit.id, {
                    'name': scope.data.userEdit.name,
                    'email': scope.data.userEdit.email,
                    'role_id': scope.data.userEdit.role_id,
                })
                    .then(function (response) {
                        $('#editUserModal').modal('hide');
                    })
                    .catch(function (err) {
                        console.log('Có lỗi xảy ra')
                    })
            }
        }
    }
})
