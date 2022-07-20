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


app.directive('editPermit', function() {
    return {
        restrict: 'E',
        templateUrl: rootUrl + 'editPermit'
    }
})
app.directive('addPermit', function () {
    return {
        restrict: 'E',
        templateUrl: rootUrl+"addPermit"
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
