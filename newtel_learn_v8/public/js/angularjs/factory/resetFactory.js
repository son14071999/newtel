app.factory('resetFactory', ['$http', 
function($http) {
    var resetFactory = {}
    resetFactory.updatePassword = function (hash, pw) {
        return $http.post(rootUrl + 'api/updatePassword?hash=' + hash, pw)
    }
    return resetFactory
}])