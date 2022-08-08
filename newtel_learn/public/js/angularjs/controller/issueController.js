app.controller('issueController', function ($scope, issueFactory) {
    $scope.data = {
        singleIssue: 0,
        title: ''
    }
    $scope.addIssue = () => {
        $scope.data.singleIssue = 0 - Math.abs($scope.data.singleIssue) - 1
        $scope.data.title = 'Add Issue'
        $('#formIssueModal').modal('show')
    }
    
})

