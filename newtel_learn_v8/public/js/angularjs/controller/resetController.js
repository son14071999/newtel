app.controller('resetController', function($scope, resetFactory) {
    $scope.data = {
        hash: (new URLSearchParams(window.location.search)).get('hash'), 
        pw: {}
    }
    $scope.updatePassword = () => {
        resetFactory.updatePassword($scope.data.hash, $scope.data.pw)
        .then((resp) => {
            window.location.replace(rootUrl+"login")
        }).catch((err) => {
            alert(err.data)
        })
    }
})