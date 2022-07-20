app.controller(
    "logoutController",
    function ($scope, logoutFactory) {
        $scope.menuActive = localStorage.getItem('menuCurrent')
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

