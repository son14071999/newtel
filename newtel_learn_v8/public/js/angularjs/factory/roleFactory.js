app.factory('roleFactory', ['$http', '$httpParamSerializer', 'functionHandle',
    function ($http, $httpParamSerializer, functionHandle) {
        var roleFactory = {}
        roleFactory.deleteRole = function ($idRole) {
            return $http.get(rootUrl + 'api/deleteListRole/' + $idRole, functionHandle.header)
        }
        roleFactory.roleInfo = function ($id) {
            return $http.get(rootUrl + 'api/showRole/' + $id, functionHandle.header)
        }
        roleFactory.saveEditRole = function ($id, $params) {
            return $http.post(rootUrl + "api/editRole/" + $id, $params, functionHandle.header)
        }
        roleFactory.saveAddRole =  function ($params) {
            return $http.post(rootUrl + "api/addRole", $params, functionHandle.header)
        }
        roleFactory.logout = async function () {
            return $http.get(rootUrl + 'api/logout', functionHandle.header)
        }
        roleFactory.getListRole = function (data) {
            var request = $http.get(rootUrl + "api/listRole?" + $httpParamSerializer(data.paramRequest), functionHandle.header)
            functionHandle.getListRole(data, request)
        }
        roleFactory.getListPermit = function (filterSearch = '') {
            return $http.get(rootUrl + "api/getAllPermit?search=" + filterSearch, functionHandle.header)
        }
        roleFactory.parentClick = function (index, listPermit) {
            listPermit[index].checked = !listPermit[index].checked
            for (let item = 0; item < listPermit[index].child_permit.length; item++) {
                listPermit[index].child_permit[item].checked = listPermit[index].checked
            }
            return listPermit
        }
        roleFactory.childClick = function (index, indexChild, listPermit) {
            listPermit[index].child_permit[indexChild].checked = !listPermit[index].child_permit[indexChild].checked
            return listPermit
        }
        roleFactory.getChecked = function (listPermit) {
            permitsChecked = []
            console.log('listPermit:', listPermit);
            listPermit.forEach(parent => {
                if (parent.checked) {
                    permitsChecked.push(parent.id)
                }
                parent.child_permit.forEach(permit => {
                    if (permit.checked) {
                        permitsChecked.push(permit.id)
                    }
                })
            })
            return permitsChecked
        }
        roleFactory.resetListPermit = (listPermit) => {
            let tmpListPermit = listPermit;
            _.each(tmpListPermit, (parentPermit, parentCode) => {
                tmpListPermit[parentCode].checked = false;
                _.each(tmpListPermit[parentCode].child_permit, (permit, permitCode) => {
                    tmpListPermit[parentCode].child_permit[permitCode].checked = false;
                });
            });

            return tmpListPermit
        }
        return roleFactory
    }
])
