app.factory('userFactory', ['$http', '$httpParamSerializer','functionHandle',
    function ($http, $httpParamSerializer, functionHandle) {
        var userFactory = {}
        userFactory.deleteUser = function ($idUser) {
            return $http.get(rootUrl + 'api/deleteListUser/' + $idUser, functionHandle.header)
        }
        userFactory.userEdit = function ($id) {
            return $http.get(rootUrl + 'api/showUser/' + $id, functionHandle.header)
        }
        userFactory.saveEditUser = function ($id, $params) {
            return $http.post(rootUrl + "api/editUser/" + $id, $params, functionHandle.header)
        }
        userFactory.saveAddUser = function ($params){
            return $http.post(rootUrl + "api/addUser", $params,functionHandle.header)
        }
        userFactory.getListUser = function(data){
            var request = $http.get(rootUrl + "api/listUser?" + $httpParamSerializer(data.paramRequest), functionHandle.header)
            functionHandle.getListUser(data, request)
        }
        userFactory.getListRole = function ($params){
            return $http.get(rootUrl + "api/getAllRole",functionHandle.header)
        }
        return userFactory
    }
])
