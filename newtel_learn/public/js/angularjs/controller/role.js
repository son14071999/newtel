app.controller('role', function ($scope, roleFactory) {
    $scope.data = {
        singleRole: 0
    };

    $scope.permitSearch = ''
    $scope.paramRequest = {
        'limit': 10,
        'search': '',
        'page': 1
    }
    $scope.roleAdd = {}
    roleFactory.getListRole($scope)

    $scope.deleteRole = function ($idRole) {
        roleFactory.deleteRole($idRole)
            .then(function (response) {
                alert(response.data.message)
                roleFactory.getListRole($scope)
            })
            .catch(function (err) {
                console.log(err)
            })
    }

    $scope.editRole = function ($id) {
        $scope.data.singleRole = $id;
        $('#editRoleModal').modal('show');
        // roleFactory.roleEdit($id)
        //     .then(function (response) {
        //         let arrPermitIdRole = response.data.role.permissions.map(p => p.id)
        //         $scope.roleEdit = response.data.role
        //         roleFactory.getListPermit()
        //             .then(function (response1) {
        //                 $scope.parentPermits = response1.data.permits
        //                 for (let index = 0; index < $scope.parentPermits.length; index++) {
        //                     for (let index1 = 0; index1 < $scope.parentPermits[index].child_permit.length; index1++) {
        //                         if (arrPermitIdRole.includes($scope.parentPermits[index].child_permit[index1].id)) {
        //                             $scope.parentPermits[index].child_permit[index1].checked = true
        //                         }
        //                     }
        //                 }

        //             }).catch(function (err) {
        //                 alert(err)
        //             })
        //     }).catch(function (err) {
        //         alert(err)
        //     });
    }

    $scope.saveEditRole = function () {

        permitsChecked = []
        $scope.parentPermits.forEach(parent => {
            $checkeds = parent.child_permit.filter(function (permit) {
                return permit.checked
            })
            permitsChecked = permitsChecked.concat($checkeds)
        })
        roleFactory.saveEditRole($scope.roleEdit.id, {
                'code': $scope.roleEdit.code,
                'name': $scope.roleEdit.name,
                'permits': permitsChecked
            })
            .then(function (response) {
                console.log(response)
                $('#editRoleModal').modal('hide');
                roleFactory.getListRole($scope)
            })
            .catch(function (err) {
                alert(err.data.message)
            })
    }

    $scope.addRole = function () {
        $scope.roleAdd = {}
        roleFactory.getListPermit()
            .then(function (response) {
                $scope.parentPermits = response.data.permits
            }).catch(function (err) {
                alert(err.data.message)
            })
        $('#addRoleModal').modal('show')
    }

    $scope.saveAddRole = function () {
        permitsChecked = []
        $scope.parentPermits.forEach(parent => {
            $checkeds = parent.child_permit.filter(function (permit) {
                return permit.checked
            })
            permitsChecked = permitsChecked.concat($checkeds)
        });
        let roleAdd = {
            'code': $scope.roleAdd.code,
            'name': $scope.roleAdd.name,
            'permits': permitsChecked
        }
        roleFactory.saveAddRole(roleAdd)
            .then(function (response) {
                $('#addRoleModal').modal('hide');
                roleFactory.getListRole($scope)
            })
            .catch(function (err) {
                alert(err.data.message)
            })
    }

    $scope.changeItemPerPage = function () {
        if ($scope.paramRequest.limit) {
            setTimeout(() => {
                roleFactory.getListRole($scope)
            }, 1000);
        }
    }


    $scope.filterNameGmail = function () {
        setTimeout(() => {
            $scope.paramRequest.page = 1
            roleFactory.getListRole($scope)
        }, 1000);

    }
    $scope.changePage = function (p) {
        if (p) {
            setTimeout(() => {
                $scope.paramRequest.page = p
                roleFactory.getListRole($scope)
            }, 100);
        }
    }

    $scope.searchPermit = function(){
        setTimeout(() => {
            roleFactory.getListPermit($scope.permitSearch)
                .then(function (response) {
                    $scope.parentPermits = response.data.permits
                }).catch(function (err) {
                    alert(err.data.message)
                })
        }, 1000);
    }

    $scope.parentClick = function (index) {
        for (let item = 0; item < $scope.parentPermits[index].child_permit.length; item++) {
            $scope.parentPermits[index].child_permit[item].checked = $scope.parentPermits[index].checked
        }
    }
});
