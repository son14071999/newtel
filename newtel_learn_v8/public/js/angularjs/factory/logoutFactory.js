app.factory('logoutFactory', ['$http','functionHandle',function($http, functionHandle){
    var logoutFactory = {}
    logoutFactory.logout = () => {
        return $http.post(rootUrl+'api/logout', {},functionHandle.header)
    }
    return logoutFactory
}])