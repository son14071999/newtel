app.value('functionHandle', {
    'getListUser': ($scope, userFactory) => {
        userFactory
            .then(function (response) {
                $scope.users = response.data.users.data
                $scope.itemPerPage = response.data.users.per_page
                $scope.pages = Array.from({ length: Math.ceil(response.data.users.total/response.data.users.per_page) }, (_, i) => i + 1)
                $scope.currentPage = response.data.users.current_page
            })
            .catch(function(err){
                if(err.status==401){
                    window.location.replace(rootUrl + "login");
                }else{
                    alert(err)
                }
            })
    },
    'header': {
        headers: {
            'token': localStorage.getItem('token'),
            'userId': localStorage.getItem('userId'),
        }

    }
})