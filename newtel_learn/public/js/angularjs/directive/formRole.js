app.directive('formRole', function (roleFactory) {
    return {
        restrict: 'E',
        templateUrl: rootUrl + 'formRole',
        scope: {
            roleId: "=",
            title: '=',
            inputData: "="
        },
        link: function (scope, element, attrs) {
            scope.data = {
                roleInfo: {},
                listPermit: {},
                listPermitTemp: {}
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
                        scope.data.listPermitTemp = scope.data.listPermit;
                    }).catch(err => console.log(err));
                },
                /**
                 *Thuc hien lay danh sach permit checked == true
                 * @returns Array
                 */
                getCheckedPermit: function () {
                    let listPermit = [];
                    _.each(scope.data.listPermit, (item) => {
                        listPermit.push(_.map(_.filter(item.child_permit, (permit) => {
                            return (permit.checked)
                        }), 'id'));
                    });
                    return _.flattenDeep(listPermit);
                }
            }

            scope.$watch('roleId', function (newVal, oldVal) {
                scope.data.listPermit = roleFactory.resetListPermit(scope.data.listPermit)
                if (Number(newVal) > 0) {
                    processData.getRole()
                } else {
                    scope.data.roleInfo = {}
                }
            });

            scope.saveRole = function () {
                if (Number(scope.roleId) <= 0) {
                    permitsChecked = processData.getCheckedPermit(scope.data.listPermit)
                    let roleInfo = {
                        'code': scope.data.roleInfo.code,
                        'name': scope.data.roleInfo.name,
                        'permits': permitsChecked
                    }
                    roleFactory.saveAddRole(roleInfo)
                        .then(function (response) {
                            $('#formRoleModal').modal('hide');
                        })
                        .catch(function (err) {
                            alert(err.data.message)
                        })
                } else {
                    permitsChecked = processData.getCheckedPermit(scope.data.listPermit)
                    roleFactory.saveEditRole(scope.data.roleInfo.id, {
                            'code': scope.data.roleInfo.code,
                            'name': scope.data.roleInfo.name,
                            'permits': permitsChecked
                        })
                        .then(function (response) {
                            $('#formRoleModal').modal('hide');
                        })
                        .catch(function (err) {
                            alert(err.data.message)
                        })
                }
                roleFactory.getListRole(scope.inputData)
                console.log('inputData1: ', scope.inputData)
            }


            scope.searchPermit = () => {
                scope.data.listPermit = _.filter(scope.data.listPermitTemp,  (item) => item.display_name.includes(scope.data.permitSearch))
            }
            processData.getListPermit();
        }
    }

})
