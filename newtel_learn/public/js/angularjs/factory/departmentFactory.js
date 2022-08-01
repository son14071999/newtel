app.factory('departmentFactory', ['$http', '$httpParamSerializer', 'functionHandle',
    function ($http, $httpParamSerializer, functionHandle) {
        var departmentFactory = {}
        departmentFactory.deleteDepartment = function ($idDepartment) {
            return $http.get(rootUrl + 'api/deleteListDepartment/' + $idDepartment, functionHandle.header)
        }
        departmentFactory.getListDepartment = function () {
            return $http.get(rootUrl + 'api/listDepartment' , functionHandle.header)
        }
        departmentFactory.departmentInfo = function ($id) {
            return $http.get(rootUrl + 'api/showDepartment/' + $id, functionHandle.header)
        }
        departmentFactory.saveEditDepartment = function ($id, $params) {
            return $http.post(rootUrl + "api/editDepartment/" + $id, $params, functionHandle.header)
        }
        departmentFactory.saveAddDepartment = function ($params) {
            return $http.post(rootUrl + "api/addDepartment", $params, functionHandle.header)
        }
        departmentFactory.getDepartment = function () {
            return $http.post(rootUrl + "api/getDepartment", functionHandle.header)
        }
        departmentFactory.logout = function () {
            return $http.post(rootUrl + 'api/logout', {}, functionHandle.header)
        }
        return departmentFactory
    }
])
