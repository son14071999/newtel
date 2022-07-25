app.directive('editRole', function (roleFactory) {
    return {
        restrict: 'E',
        templateUrl: rootUrl + 'editRole',
        scope: {
            roleId: "="
        },
        link: function (scope, element, attrs) {
            scope.data = {
                roleInfo: {},
                parentPermit: {},
                childPermit: [],
                listPermit: []
            }

            let processData = {
                getRole: function () {
                    roleFactory.roleInfo(scope.roleId).then((resp) => {
                        scope.data.roleInfo = resp.data.role
                        scope.data.childPermit = resp.data.permitCodes
                        for (let index = 0; index < scope.data.listPermit.length; index++) {
                            if (scope.data.childPermit.includes(scope.data.listPermit[index].code)) {
                                scope.data.listPermit[index].checked = true
                            }

                            for (let indexChild = 0; indexChild < scope.data.listPermit[index].child_permit.length; indexChild++) {
                                if (scope.data.childPermit.includes(scope.data.listPermit[index].child_permit[indexChild].code)) {
                                    scope.data.listPermit[index].child_permit[indexChild].checked = true
                                }
                            }
                        }
                    }).catch(err => console.log(err));
                },
                getListPermit: function () {
                    roleFactory.getListPermit().then((resp) => {
                        scope.data.listPermit = resp.data.permits;
                    }).catch(err => console.log(err));
                }
            }
            scope.$watch('roleId', function (newVal, oldVal) {
                if (!newVal) return false;
                processData.getListPermit();
                processData.getRole();
            });
            scope.parentClick = function (index) {
                scope.data.listPermit = roleFactory.parentClick(index, scope.data.listPermit)
            }
            scope.childClick = function (index, indexChild) {
                scope.data.listPermit = roleFactory.childClick(index, indexChild, scope.data.listPermit)
            }
            scope.saveEditRole = function () {
                permitsChecked = roleFactory.getChecked(scope.data.listPermit)
                roleFactory.saveEditRole(scope.data.roleInfo.id, {
                    'code': scope.data.roleInfo.code,
                    'name': scope.data.roleInfo.name,
                    'permits': permitsChecked
                })
                    .then(function (response) {
                        $('#editRoleModal').modal('hide');
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
    }
})
