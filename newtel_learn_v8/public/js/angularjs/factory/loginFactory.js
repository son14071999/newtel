app.factory('loginFactory', ['$http', 'functionHandle',
    function ($http, functionHandle) {
        var loginFactory = {}
        loginFactory.login = function (params) {
            let url = rootUrl + "api/login";
            return $http.post(url, params)
        }
        loginFactory.sentMailForgotPw = (email) => {
            return $http.post(rootUrl + 'api/forgotPassword', { 'email': email })
        }
        loginFactory.getAccessToken = (clientId, clientSecret, username, password, scope) => {
            return $http.post(rootUrl + 'oauth/token', {
                'grant_type': 'password',
                'client_id': clientId,
                'client_secret': clientSecret,
                'username':  username,
                'password': password,
                'scope': scope,
            })
        }

        loginFactory.getredirect = (clientId, clientSecret) => {
            return $http.post(rootUrl + 'api/getredirect', {
                'clientId': clientId,
                'clientSecret': clientSecret
            }, functionHandle.header)
        }

        loginFactory.getPermitsUser = function(email, password) {
            return $http.post('api/getPermitsUser', {
                'email': email, 
                'password': password
            })
        }
        return loginFactory
    }
])