app.factory('loginFactory' ,['$http', 'functionHandle', 
    function($http, functionHandle){
        var loginFactory = {}
        loginFactory.login = function($params){
            let url = rootUrl + "api/login";
            return  $http.post(url, $params)
        }
        return loginFactory
    }
])