
app.directive('addRole', function (roleFactory) {
    return {
        restrict: 'E',
        templateUrl: rootUrl + "formRole",
        link: function (scope, element, attrs) {
            scope.data = {
                roleInfo: {},
                listPermit: []
            }
            roleFactory.getListPermit()
                .then(function (response) {
                    scope.data.listPermit = response.data.permits
                }).catch(function (err) {
                    alert(err.message)
                })
            scope.parentClick = function (index) {
                scope.data.listPermit = roleFactory.parentClick(index, scope.data.listPermit)
            }
            scope.childClick = function (index, indexChild) {
                scope.data.listPermit = roleFactory.childClick(index, indexChild, scope.data.listPermit)
            }
            scope.saveAddRole = function () {
                permitsChecked = roleFactory.getChecked(scope.data.listPermit)
                let roleInfo = {
                    'code': scope.data.roleInfo.code,
                    'name': scope.data.roleInfo.name,
                    'permits': permitsChecked
                }
                roleFactory.saveAddRole(roleInfo)
                    .then(function (response) {
                        $('#editRoleModal').modal('hide');
                        roleFactory.getListRole(scope)
                    })
                    .catch(function (err) {
                        alert(err.data.message)
                    })
            }
            scope.$watch('roleId', (newVal, oldVal) => {
                console.log(12345);
                if(newVal) return true
                scope.data.listPermit = roleFactory.resetListPermit(scope.data.listPermit)

            })
            scope.searchPermit = () => {
                setTimeout(() => {
                    roleFactory.getListPermit(scope.data.permitSearch)
                        .then(function (response) {
                            scope.data.parentPermits = response.data.permits
                            scope.data.listPermit = response.data.permits;
                        }).catch(function (err) {
                            alert(err.data.message)
                        })
                }, 1000);
            }
        }
    };
})
