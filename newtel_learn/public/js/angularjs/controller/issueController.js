app.controller('issueController', function($scope, issueFactory) {
    $scope.data = {
        singleIssue: 0,
        title: ''
    }
    $scope.addIssue = () => {
        $scope.data.singleIsssue = 0;
        $scope.data.title = 'Add Issue'
        $('#formIssueModal').modal('show')
    }
})