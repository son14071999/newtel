app.controller('role', function ($scope, roleFactory) {
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
        roleFactory.roleEdit($id)
            .then(function (response) {
                $scope.roleEdit = response.data.role
                $scope.permits = response.data.permits
                $('#editRoleModal').modal('show')
            }).catch(function (err) {
                alert(err.data.message)
            })
    }

    $scope.saveEditRole = function () {
        var permitsChecked = $scope.permits.filter(function(permit){
            return permit.checked
        })
        roleFactory.saveEditRole($scope.roleEdit.id, {
            'code': $scope.roleEdit.code,
            'name': $scope.roleEdit.name,
            'permits' : permitsChecked
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
        .then(function(response){
            $scope.parentPermits = response.data.permits
        }).catch(function (err){
            alert(err.data.message)
        })
        $('#addRoleModal').modal('show')
    }

    $scope.saveAddRole = function () {
        permitsChecked = []
        $scope.parentPermits.forEach(parent => {
            $checkeds = parent.child_permit.filter(function(permit){
               return permit.checked
           })
           permitsChecked = permitsChecked.concat($checkeds)
        });
        let roleAdd = {
            'code': $scope.roleAdd.code,
            'name': $scope.roleAdd.name,
            'permits' : permitsChecked
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

    $scope.parentClick = function(index){
        for(let item=0; item < $scope.parentPermits[index].child_permit.length; item++){
            $scope.parentPermits[index].child_permit[item].checked = $scope.parentPermits[index].checked
        }
        console.log($scope.parentPermits);
    }
});
