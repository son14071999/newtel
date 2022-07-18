app.factory('logoutFactory', ['$http','functionHandle',function($http){
    var logoutFactory = {}
    logoutFactory.logout = () => {
        return $http.post(rootUrl+'api/logout', {},functionHandle.header)
    }
    return logoutFactory
}])