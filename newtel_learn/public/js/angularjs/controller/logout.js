app.controller(
    "logoutController",
    function ($scope) {
        $scope.login = function () {
            logoutFactory.logout()
                .then((response) => {
                    window.location.replace(rootUrl + 'login')
                }).catch((err) => {
                    alert('Logout thất bại')
                })
        };
    }
);

