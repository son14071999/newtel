app.factory('clientFactory', ['$http', '$httpParamSerializer', 'functionHandle',
    function ($http, $httpParamSerializer, functionHandle) {
        var clientFactory = {}
        clientFactory.deleteClient = function ($idClient) {
            return $http.delete(rootUrl + 'api/deleteClient/' + $idClient, functionHandle.header)
        }
        clientFactory.clientInfo = function ($id) {
            return $http.get(rootUrl + 'api/showClient/' + $id, functionHandle.header)
        }
        clientFactory.saveEditClient = function ($id, $params) {
            return $http.post(rootUrl + "api/editClient/" + $id, $params, functionHandle.header)
        }
        clientFactory.saveAddClient =  function ($params) {
            return $http.post(rootUrl + "api/addClient", $params, functionHandle.header)
        }
        clientFactory.logout = async function () {
            return $http.post(rootUrl + 'api/logout', {}, functionHandle.header)
        }
        clientFactory.getListClient = function (data) {
            $http.get(rootUrl + "api/listClient?" + $httpParamSerializer(data.paramRequest), functionHandle.header)
            .then((resp) => {
                data.clients = resp.data.clients
                data.allClient = data.clients
                data.clientsDisplay = data.clients
            }).catch((err) => {
                console.log(err)
            })
            clientFactory.config(data)
        }

        clientFactory.config = (data) => {
            data.pages = Array.from({ length: Math.ceil(data.clients.length/data.itemPerPage) }, (_, i) => i + 1)
            start = data.itemPerPage * (data.currentPage-1)
            data.clientsDisplay = data.clients.slice(start, start + data.itemPerPage)
        }
        clientFactory.getListPermit = function (filterSearch = '') {
            return $http.get(rootUrl + "api/getAllPermit?search=" + filterSearch, functionHandle.header)
        }
        clientFactory.parentClick = function (index, listPermit) {
            listPermit[index].checked = !listPermit[index].checked
            for (let item = 0; item < listPermit[index].child_permit.length; item++) {
                listPermit[index].child_permit[item].checked = listPermit[index].checked
            }
            return listPermit
        }
        clientFactory.childClick = function (index, indexChild, listPermit) {
            listPermit[index].child_permit[indexChild].checked = !listPermit[index].child_permit[indexChild].checked
            return listPermit
        }
        clientFactory.getChecked = function (listPermit) {
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
        clientFactory.resetListPermit = (listPermit) => {
            let tmpListPermit = listPermit;
            _.each(tmpListPermit, (parentPermit, parentCode) => {
                tmpListPermit[parentCode].checked = false;
                _.each(tmpListPermit[parentCode].child_permit, (permit, permitCode) => {
                    tmpListPermit[parentCode].child_permit[permitCode].checked = false;
                });
            });

            return tmpListPermit
        }
        return clientFactory
    }
])
