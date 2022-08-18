app.controller('clientController', function ($scope, clientFactory) {
    $scope.data = {
        singleClient: 0,
        title: '',
        search: '',
        clients: [],
        allClient: [],
        clientsDisplay: [],
        currentPage: 1,
        itemPerPage: 10,
        pages: 1
    };
    clientFactory.getListClient($scope.data)
    $scope.deleteClient = function ($idClient) {
        clientFactory.deleteClient($idClient)
            .then(function (response) {
                alert(response.data)
                clientFactory.getListClient($scope.data)
            })
            .catch(function (err) {
                console.log(err)
            })
    }

    $scope.editClient = function ($id) {
        $scope.data.singleClient = $id;
        $scope.data.title = 'Edit Client'
        $('#formClientModal').modal('show');
    }

    $scope.addClient = function () {
        $scope.data.singleClient = 0 - Math.abs($scope.data.singleClient) - 1;
        $scope.data.title = 'Add Client'
        $('#formClientModal').modal('show')
    }


    $scope.changeItemPerPage = function () {
        if ($scope.data.itemPerPage) {
            clientFactory.config($scope.data)

        }
    }


    $scope.filters = function () {
        $scope.data.clients = $scope.data.allClient
        $scope.data.clients = _.filter($scope.data.clients, (item) => {
            if(item.redirect.includes($scope.data.search) || item.name.includes($scope.data.search)){
                return item
            }
        })
        $scope.data.currentPage = 1
        clientFactory.config($scope.data)


    }
    $scope.changePage = function (p) {
        if (p) {
            $scope.data.currentPage = p
            clientFactory.config($scope.data)
           
        }
    }


});
