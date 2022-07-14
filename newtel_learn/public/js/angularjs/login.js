app.controller(
    "loginController",
    function ($scope, $http) {
        $scope.login = function () {
            $scope.errorMessage = "";
            $scope.errorStatus = false;
            let url = rootUrl + "api/login";
            console.log(url);
            $http
                .post(url, $scope.user)
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
