app.directive('formClient', function (clientFactory) {
    return {
        restrict: 'E',
        templateUrl: rootUrl + 'formClient',
        scope: {
            clientId: "=",
            title: '=',
            inputData: "="
        },
        link: function (scope, element, attrs) {
            scope.data = {
                clientInfo: {},
                listPermit: {},
                listPermitTemp: {}
            }


            let processData = {
                /**
                 * Thuc hien lay thong tin cua client
                 */
                getClient: function () {
                    clientFactory.clientInfo(scope.clientId).then((resp) => {
                        scope.data.clientInfo = resp.data;
                    }).catch(err => console.log(err));
                }
            }

            scope.$watch('clientId', function (newVal, oldVal) {
                scope.data.listPermit = clientFactory.resetListPermit(scope.data.listPermit)
                if (Number(newVal) > 0) {
                    processData.getClient()
                } else {
                    scope.data.clientInfo = {}
                }
            });

            scope.saveClient = function () {
                if (Number(scope.clientId) <= 0) {
                    let clientInfo = scope.data.clientInfo
                    clientFactory.saveAddClient(clientInfo)
                        .then(function (response) {
                            $('#formClientModal').modal('hide');
                        })
                        .catch(function (err) {
                            console.log(err);
                        })
                } else {
                    clientFactory.saveEditClient(scope.data.clientInfo.id, scope.data.clientInfo)
                        .then(function (response) {
                            $('#formClientModal').modal('hide');
                        })
                        .catch(function (err) {
                            console.log(err)
                        })
                }
                clientFactory.getListClient(scope.inputData)
            }


        }
    }

})
