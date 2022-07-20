app.factory('roleFactory', ['$http', '$httpParamSerializer','functionHandle', 
    function($http, $httpParamSerializer, functionHandle){
        var roleFactory = {}
        roleFactory.deleteRole = function ($idRole) {
            return $http.get(rootUrl + 'api/deleteListRole/' + $idRole, functionHandle.header)
        }
        roleFactory.roleEdit = function ($id) {
            return $http.get(rootUrl + 'api/showRole/' + $id, functionHandle.header)
        }
        roleFactory.saveEditRole = function ($id, $params) {
            return $http.post(rootUrl + "api/editRole/" + $id, $params, functionHandle.header)
        }
        roleFactory.saveAddRole = function ($params){
            return $http.post(rootUrl + "api/addRole", $params,functionHandle.header)
        }
        roleFactory.logout = function(){
            return $http.post(rootUrl+'api/logout', {},functionHandle.header)
        }
        roleFactory.getListRole = function($scope){
            var request = $http.get(rootUrl + "api/listRole?" + $httpParamSerializer($scope.paramRequest), {
                headers: {
                    'token': localStorage.getItem('token'),
                    'userId': localStorage.getItem('userId'),
                }
            })
            functionHandle.getListRole($scope, request)
        }
        return roleFactory
    }
])