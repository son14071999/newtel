app.directive('editRole', function (roleFactory) {
    let link = function (scope, element, attrs) {
        scope.data = {
            roleInfo: {},
            listPermit: {}
        }

        scope.action = {
            /**
             * Thuc hien check va uncheck all cac permit
             * @param {*} parentCode
             */
            toggleParentPermit: function (parentCode) {
                scope.data.listPermit[parentCode].child_permit = _.map(scope.data.listPermit[parentCode].child_permit, (item) => {
                    item.checked = scope.data.listPermit[parentCode].checked;
                    return item;
                });
            }
        }

        let processData = {
            /**
             * Thuc hien reset checked cua listPermit ve false
             */
            resetListPermit: function(){
                let tmpListPermit = scope.data.listPermit;
                _.each(tmpListPermit, (parentPermit, parentCode) => {
                    tmpListPermit[parentCode].checked = false;
                    _.each(tmpListPermit[parentCode].child_permit, (permit, permitCode) => {
                        tmpListPermit[parentCode].child_permit[permitCode].checked = false;
                    });
                });

                scope.data.listPermit = tmpListPermit;
            },
            /**
             * Thuc hien gan quyen cua role vao listPermit (Xu ly checked)
             */
            rolePermit: function () {
                let tmpRolePermit = _.map(scope.data.roleInfo.permissions, 'code');
                _.each(scope.data.listPermit, (parentPermit, parentCode) => {
                    _.each(scope.data.listPermit[parentCode].child_permit, (permit, permitCode) => {
                        if (tmpRolePermit.indexOf(permitCode) != -1) scope.data.listPermit[parentCode].child_permit[permitCode].checked = true
                    });
                });

                _.each(scope.data.listPermit, (parentPermit, parentCode) => {
                    if (
                        _.filter(parentPermit.child_permit, (item) => {
                            return (item.checked === false)
                        }).length < 1
                    ) {
                        scope.data.listPermit[parentCode].checked = true;
                    }
                });
            },
            /**
             * Thuc hien lay thong tin cua role
             */
            getRole: function () {
                roleFactory.roleInfo(scope.roleId).then((resp) => {
                    scope.data.roleInfo = resp.data.role;
                    console.log(resp.data.role, 'resp.data.role');
                    this.rolePermit();
                }).catch(err => console.log(err));
            },
            /**
             * Lay danh sach mac dinh quyen cua he thong
             */
            getListPermit: function () {
                roleFactory.getListPermit().then((resp) => {
                    let tmpPermit = resp.data.permits;

                    tmpPermit = _.map(tmpPermit, (permit) => {
                        permit.checked = false;
                        permit.child_permit = _.map(permit.child_permit, (childPermit) => {
                            childPermit.checked = false;
                            return childPermit;
                        });

                        permit.child_permit = _.keyBy(permit.child_permit, (childPermit) => {
                            return childPermit.code
                        });

                        return permit;
                    });

                    tmpPermit = _.keyBy(tmpPermit, (item) => {
                        return item.code
                    });

                    scope.data.listPermit = tmpPermit;
                    console.log(scope.data.listPermit, 'scope.data.listPermit');
                }).catch(err => console.log(err));
            },
            /**
             *Thuc hien lay danh sach permit checked == true
             * @returns Array
             */
            getCheckedPermit: function(){
                let listPermit = [];
                _.each(scope.data.listPermit, (item) => {
                    listPermit.push(_.map(_.filter(item.child_permit, (permit) => {return (permit.checked)}), 'code'));
                });
                console.log(listPermit, 'listPermit');
                return _.flattenDeep(listPermit);
            }
        }

        scope.$watch('roleId', function (newVal, oldVal) {
            if (!newVal) return false;
            processData.resetListPermit();
            processData.getRole();
        });


        scope.saveEditRole = function () {
            console.log(scope.data.listPermit);
            console.log(processData.getCheckedPermit());
            return false;
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

        // scope.searchPermit = () => {
        //     setTimeout(() => {
        //         roleFactory.getListPermit(scope.data.permitSearch)
        //             .then(function (response) {
        //                 scope.data.parentPermits = response.data.permits
        //                 scope.data.listPermit = response.data.permits;
        //             }).catch(function (err) {
        //                 alert(err.data.message)
        //             })
        //     }, 1000);
        // }

        processData.getListPermit();
    };

    return {
        restrict: 'E',
        templateUrl: rootUrl + 'editRole',
        scope: {
            roleId: "="
        },
        link: link
    }
})
