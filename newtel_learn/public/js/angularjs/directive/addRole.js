
app.directive('addRole', function (roleFactory) {
    return {
        restrict: 'E',
        templateUrl: rootUrl + "addRole",
        link: function (scope, element, attrs) {
            scope.data = {
                roleAdd: {},
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
                console.log(scope.data.listPermit);
                permitsChecked = roleFactory.getChecked(scope.data.listPermit)
                let roleAdd = {
                    'code': scope.data.roleAdd.code,
                    'name': scope.data.roleAdd.name,
                    'permits': permitsChecked
                }
                roleFactory.saveAddRole(roleAdd)
                    .then(function (response) {
                        $('#addRoleModal').modal('hide');
                        roleFactory.getListRole(scope)
                    })
                    .catch(function (err) {
                        alert(err.data.message)
                    })
            }
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
