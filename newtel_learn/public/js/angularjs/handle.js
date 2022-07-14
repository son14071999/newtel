app.value('functionHandle', {
    'insertUrl': function (name, value) {
        var url = window.location.href;
        url = url.replaceAll('#?', "?")
        url = url.replaceAll('#&', "&")
        var regex = new RegExp(name + '=[^&]*', 'i');
        let result = url.match(regex);
        if (result) {
            regex = new RegExp('(.*' + name + '=)([^&]*)(.*)', 'i');
            // let pattern = /(.*limit=)([0-9]+)(.*)/i;
            url = url.replace(regex, "$1" + value + "$3");
        } else {
            if (url.indexOf('?') > -1) {
                url += '&' + name + '=' + value
            } else {
                url += '?' + name + '=' + value
            }
        }
        return url
    },
    'getListUser': ($scope, $http) => {
        $http.get(rootUrl + "api/listUser?limit=" + $scope.limit + "&search=" + $scope.search + '&page=' + $scope.page, {
            headers: {
                'token': localStorage.getItem('token'),
                'userId': localStorage.getItem('userId'),
            }
        })
            .then(function (response) {
                $scope.users = response.data.users;
                $scope.itemPerPage = response.data.itemPerPage
                $scope.pages = Array.from({ length: response.data.pages }, (_, i) => i + 1)
                $scope.currentPage = response.data.page
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