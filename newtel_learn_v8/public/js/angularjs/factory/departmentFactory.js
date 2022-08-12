app.factory('departmentFactory', ['$http', '$httpParamSerializer', 'functionHandle',
    function ($http, $httpParamSerializer, functionHandle) {
        var departmentFactory = {}
        departmentFactory.deleteDepartment = function ($idDepartment) {
            return $http.get(rootUrl + 'api/deleteDepartment/' + $idDepartment, functionHandle.header)
        }
        departmentFactory.getListDepartment = function () {
            return $http.get(rootUrl + 'api/listDepartment', functionHandle.header)
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
        departmentFactory.updateDepartments = (departments) => {
            departments = departmentFactory.addPath(departments)
            _.map(departments, (department) => {

                return departmentFactory.setDefault(departments, department)
            })
            return departments
        }
        departmentFactory.hasChild = (departments, id) => {
            for (let i = 0; i < departments.length; i++) {
                if (departments[i].parent_id == id) {
                    return true
                }
            }
            return false
        }
        departmentFactory.setDefault = (departments, department) => {
            department.paddingLeft = department.path.split('/').length * 20 + "px"
            department.hasChild = departmentFactory.hasChild(departments, department.id)
            department.iconAction = 'down'
            department.show = true
            return department
        }

        departmentFactory.addPath = (departments) => {
            _.map(departments, (department) => {
                let path = ''
                let parents = department.path.split('/')
                _.each(parents, (parentId) => {
                    path += '/' + _.find(departments, (e) => e.id == parentId).name
                })
                department.pathName = path
                return department
            })
            return departments
        }
        return departmentFactory
    }
])
