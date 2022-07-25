app.controller(
    "menuController",
    function ($scope, logoutFactory) {
        let url = window.location.href
        $scope.menuActive = 'user'
        if (url.indexOf('listRole') != -1) {
            $scope.menuActive = 'role'
        }
        $scope.logout = function () {
            logoutFactory.logout()
                .then((response) => {
                    window.location.replace(rootUrl + 'login')
                }).catch((err) => {
                    alert('Logout thất bại')
                })
        };
    }
);
