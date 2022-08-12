app.controller('issueController', function ($scope, issueFactory) {
    $scope.data = {
        singleIssue: 0,
        title: '',
        issuesTemp: [],
        issues: [],
        issuesDisplay: [],
        config: {
            itemPerPage: 10,
            pages:1,
            currentPage: 1,
            search: ''
        }
    }
    $scope.addIssue = () => {
        $scope.data.singleIssue = 0 - Math.abs($scope.data.singleIssue) - 1
        $scope.data.title = 'Add Issue'
        $('#formIssueModal').modal('show')
    }

    $scope.changeItemPerPage = () => {
        issueFactory.setConfig($scope.data)
    }

    $scope.changePage = (p) => {
        $scope.data.config.currentPage = p
        issueFactory.setConfig($scope.data)
    }

    $scope.search = () => {
        $scope.data.issues = $scope.data.issuesTemp
        console.log($scope.data.issues);
        $scope.data.issues = _.filter($scope.data.issues, (item) => {
            if(item.name.includes($scope.data.config.search) || item.descripttion.includes($scope.data.config.search)) {
                return item
            }
        })
        issueFactory.setConfig($scope.data)
    }

    issueFactory.getListIssue($scope.data)

})

