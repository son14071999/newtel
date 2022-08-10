app.controller(
    "loginController",
    function ($scope, loginFactory) {
        $scope.data = {
            showFormLogin: true,
            showFormForgotPassword: false,
            showMessageSent: false,
            title: 'Đăng nhập'
        }
        $scope.user = {}
        $scope.login = function () {
            loginFactory.login($scope.user)
                .then(function (response) {
                    console.log('response: ', response)
                    localStorage.setItem('accessToken', response.data.token)
                    // localStorage.setItem('userId', response.data.userId)
                    window.location.replace(rootUrl + "listUser");
                })
                .catch(function (err) {
                    alert('Tài khoản hoặc mật khẩu sai')
                });
        };

        $scope.showFormlogin = () => {
            $scope.data.title = 'Đăng nhập'
            $scope.data.showFormLogin = true
            $scope.data.showFormForgotPassword = false
            $scope.data.showMessageSent = false
        }
        $scope.showFormForgotPassword = () => {
            $scope.data.title = 'Quên mật khẩu'
            $scope.data.showFormLogin = false
            $scope.data.showFormForgotPassword = true
            $scope.data.showMessageSent = false
        }
        $scope.resetPassword = () => {
            loginFactory.sentMailForgotPw($scope.user.email)
            .then((resp) => {
                console.log(resp)
            }).catch((err) => {
                console.log(err)
            })
            $scope.data.title = 'Gửi mail thành công'
            $scope.data.showFormLogin = $scope.data.showFormForgotPassword = false
            $scope.data.showMessageSent = true
        }
    }
);
