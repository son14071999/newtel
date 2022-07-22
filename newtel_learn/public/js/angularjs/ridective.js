app.directive('editUser', function () {
    return {
        restrict: 'E',
        templateUrl: rootUrl+"editUser"
    };
})
app.directive('addUser', function () {
    return {
        restrict: 'E',
        templateUrl: rootUrl+"addUser"
    };
})

app.directive('editRole', function(roleFactory) {
    return {
        restrict: 'E',
        templateUrl: rootUrl + 'editRole',
        scope: {
            roleId: "="
        },
        link: function(scope, element, attrs){
            scope.data = {
                roleInfo: {},
                parentPermit: {},
                childPermit: {},
                listPermit: []
            }

            let processData = {
                getRole: function(){
                    roleFactory.roleInfo(scope.roleId).then((resp) => {
                        console.log(resp.data);
                    }).catch(err => console.log(err));
                },
                getListPermit: function(){
                    roleFactory.getListPermit().then((resp) => {
                        scope.data.listPermit = resp.data.permits;

                        console.log('scope.data.listPermit', resp.data.permits);
                    }).catch(err => console.log(err));
                }
            }

            scope.$watch('roleId', function(newVal, oldVal){
                if(!newVal) return false;
                processData.getRole();
            });

            processData.getListPermit();
        }
    }
})
app.directive('addRole', function () {
    return {
        restrict: 'E',
        templateUrl: rootUrl+"addRole"
    };
})
