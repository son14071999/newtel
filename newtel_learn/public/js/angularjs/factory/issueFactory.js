app.factory('issueFactory' ,['$http', 'functionHandle', 
    function($http, functionHandle){
        var issueFactory = {}
        issueFactory.getListStatuses = (parentId) => {
            return $http.get(rootUrl + 'api/getListStatus/' + parentId, functionHandle.header)
        }
        
        issueFactory.saveIssue = (data) => {
            return $http.post(rootUrl + 'api/addIssue', {
                'name': data.parameters.name,
                'descripttion': data.parameters.descripttion,
                'executor_id' : data.parameters.executor_id,
                'deadline': data.parameters.deadline ? data.parameters.deadline.getTime() : ''

            }, functionHandle.header)
        }, 
        issueFactory.getListUser = () => {
            return $http.get(rootUrl + 'api/listUser', functionHandle.header)
        }
        return issueFactory
    }
])