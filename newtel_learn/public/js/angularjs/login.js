app.controller(
    "loginController",
    function ($scope, $http, convertObjectToString, configURL) {
        $scope.user = {
            email: "",
            password: "",
        };

        $scope.login = function () {
            $scope.errorMessage = "";
            $scope.errorStatus = false;
            let url = rootUrl + "api/login";
            $http
                .post(url, $scope.user)
                .then(function (response) {
                    console.log(response);
                    $scope.errorMessage = "";
                    // window.location.replace(rootUrl + "listUser");
                })
                .catch(function (err) {
                    console.log(err);
                    $scope.errorStatus = true;
                    $scope.errorMessage = response.data.messageError;
                });
        };
    }
);
