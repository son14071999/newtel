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
            url = new URL(window.location.href)
            clientId = url.searchParams.get('clientId')
            clientSecret = url.searchParams.get('clientSecret')
            if (clientId && clientSecret) {
                loginFactory.getAccessToken(clientId, clientSecret, $scope.user.email, $scope.user.password)
                    .then((resp) => {
                        localStorage.setItem('token', resp.data.access_token)
                        loginFactory.getredirect(clientId, clientSecret)
                            .then((subResp) => {
                                redirect = subResp.data.redirect
                                char = redirect.includes('?') ? '&' : '?'
                                window.location.replace(redirect + char + 'accessToken=' + resp.data.access_token + '&refreshToken=' + resp.data.refresh_token + '&expires_in=' + resp.data.expires_in)
                            }).catch((err) => {
                                console.log(err)
                            })
                    }).catch((err) => {
                        console.log(err)
                    })
            } else {
                loginFactory.login($scope.user)
                    .then(function (response) {
                        localStorage.setItem('token', response.data)
                        window.location.replace(rootUrl + "listUser");
                    })
                    .catch(function (err) {
                        alert('Tài khoản hoặc mật khẩu sai')
                    });
            }
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
