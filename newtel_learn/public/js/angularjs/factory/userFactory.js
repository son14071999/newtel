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
        userFactory.getListUser = function($scope){
            var request = $http.get(rootUrl + "api/listUser?" + $httpParamSerializer($scope.paramRequest), {
                headers: {
                    'token': localStorage.getItem('token'),
                    'userId': localStorage.getItem('userId'),
                }
            })
            functionHandle.getListUser($scope, request)
        }
        return userFactory
    }
])
