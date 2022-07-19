app.factory('permitFactory', ['$http', '$httpParamSerializer','functionHandle', 
    function($http, $httpParamSerializer, functionHandle){
        var permitFactory = {}
        permitFactory.deletePermit = function ($idPermit) {
            return $http.get(rootUrl + 'api/deleteListPermit/' + $idPermit, functionHandle.header)
        }
        permitFactory.permitEdit = function ($id) {
            return $http.get(rootUrl + 'api/showPermit/' + $id, functionHandle.header)
        }
        permitFactory.saveEditPermit = function ($id, $params) {
            return $http.post(rootUrl + "api/editPermit/" + $id, $params, functionHandle.header)
        }
        permitFactory.saveAddPermit = function ($params){
            return $http.post(rootUrl + "api/addPermit", $params,functionHandle.header)
        }
        permitFactory.logout = function(){
            return $http.post(rootUrl+'api/logout', {},functionHandle.header)
        }
        permitFactory.getListPermit = function($scope){
            var request = $http.get(rootUrl + "api/listPermit?" + $httpParamSerializer($scope.paramRequest), {
                headers: {
                    'token': localStorage.getItem('token'),
                    'userId': localStorage.getItem('userId'),
                }
            })
            functionHandle.getListPermit($scope, request)
        }
        return permitFactory
    }
])