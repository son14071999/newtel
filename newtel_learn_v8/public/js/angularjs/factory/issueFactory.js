app.factory('issueFactory', ['$http', '$httpParamSerializer', 'functionHandle',
    function ($http, $httpParamSerializer, functionHandle) {
        var issueFactory = {}
        issueFactory.getListStatuses = (parentId) => {
            return $http.get(rootUrl + 'api/getListStatus/' + parentId, functionHandle.header)
        }

        issueFactory.saveIssue = (data) => {
            return $http.post(rootUrl + 'api/addIssue', {
                'name': data.parameters.name,
                'descripttion': data.parameters.descripttion,
                'executor_id': data.parameters.executor_id,
                'deadline': data.parameters.deadline ? data.parameters.deadline.getTime() : ''

            }, functionHandle.header)
        },
            issueFactory.getListUser = () => {
                return $http.get(rootUrl + 'api/listUser', functionHandle.header)
            }

        issueFactory.getListIssue = (data) => {
            var request = $http.get(rootUrl + "api/listIssue?" + $httpParamSerializer(data.paramRequest), functionHandle.header)
                .then((resp) => {
                    data.issues = resp.data
                    data.issuesTemp = resp.data
                    issueFactory.setConfig(data)
                }).catch((err) => {
                    console.log(err)
                })

        }

        issueFactory.setConfig = (data) => {
            // data.issues = data.issuesTemp
            data.config.pages = Array.from({ length: Math.ceil(data.issues.length / data.config.itemPerPage) }, (_, i) => i + 1)
            start = (data.config.currentPage - 1) * data.config.itemPerPage
            data.issuesDisplay = data.issues.slice(start, start+data.config.itemPerPage)
            if(data.issuesDisplay.length==0){
                data.config.currentPage = 1
                data.issuesDisplay = data.issues
            }


        }
        return issueFactory
    }
])
