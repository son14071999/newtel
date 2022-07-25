
app.directive('addUser', function (userFactory) {
    return {
        restrict: 'E',
        templateUrl: rootUrl + "addUser",
        link: (scope, element, attrs) => {
            scope.data = {
                userAdd: {},
                roles: {}
            }
            userFactory.getListRole()
                .then((response) => {
                    scope.data.roles = response.data.roles
                }).catch((err) => {
                    alert(err)
                })
            scope.saveAddUser = () => {
                userFactory.saveAddUser(scope.data.userAdd)
                    .then(function (response) {
                        $('#addUserModal').modal('hide');
                        userFactory.getListUser(scope.data)
                    })
                    .catch(function (err) {
                        alert('Có lỗi xảy ra')
                    })
            }
        }
    };
})
