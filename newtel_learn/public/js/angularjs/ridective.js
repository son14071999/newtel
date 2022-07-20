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

app.directive('editRole', function() {
    return {
        restrict: 'E',
        templateUrl: rootUrl + 'editRole'
    }
})
app.directive('addRole', function () {
    return {
        restrict: 'E',
        templateUrl: rootUrl+"addRole"
    };
})
