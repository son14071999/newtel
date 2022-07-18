app.controller(
    "loginController",
    function ($scope, loginFactory) {
        $scope.login = function () {
            loginFactory.login($scope.user)
                .then(function (response) {
                    localStorage.setItem('token', response.data.userSession.token)
                    localStorage.setItem('userId', response.data.userId)
                    window.location.replace(rootUrl + "listUser");
                })
                .catch(function (err) {
                    alert('Tài khoản hoặc mật khẩu sai')
                });
        };
    }
);
