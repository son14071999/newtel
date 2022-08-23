app.factory('issueFactory', ['$http', '$httpParamSerializer', 'functionHandle',
    function ($http, $httpParamSerializer, functionHandle) {
        var issueFactory = {}
        issueFactory.getListStatuses = (parentId) => {
            return $http.get(rootUrl + 'api/getListStatus/' + parentId, functionHandle.header)
        }

        issueFactory.saveIssue = (data) => {
            data.deadline = data.deadline ? data.deadline.getTime() : ''
            return $http.post(rootUrl + 'api/addIssue', data, functionHandle.header)
        }


        issueFactory.editIssue = (data, id) => {
            data.deadline = data.deadline ? data.deadline.getTime() : ''
            return $http.post(rootUrl + 'api/editIssue/' + id, data, functionHandle.header)
        }


        issueFactory.deleteIssue = (id) => {
            return $http.delete(rootUrl + 'api/deleteIssue/' + id, functionHandle.header)
        }

        

        issueFactory.getListUser = () => {
            return $http.get(rootUrl + 'api/getListUser', functionHandle.header)
        }


        issueFactory.getIssue = (id) => {
            return $http.get(rootUrl + 'api/getIssue/' + id, functionHandle.header)
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
            data.config.pages = Array.from({
                length: Math.ceil(data.issues.length / data.config.itemPerPage)
            }, (_, i) => i + 1)
            start = (data.config.currentPage - 1) * data.config.itemPerPage
            data.issuesDisplay = data.issues.slice(start, start + data.config.itemPerPage)
            if (data.issuesDisplay.length == 0) {
                data.config.currentPage = 1
                data.issuesDisplay = data.issues
            }


        }
        return issueFactory
    }
])
