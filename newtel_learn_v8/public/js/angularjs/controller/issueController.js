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
        },
        statuses: [],
        status: 0,
        startTime: null,
        endTime: null,
    }
    $scope.addIssue = () => {
        $scope.data.singleIssue = 0 - Math.abs($scope.data.singleIssue) - 1
        $scope.data.title = 'Add Issue'
        $('#formIssueModal').modal('show')
    }

    $scope.editIssue = (issueId) => {
        $scope.data.singleIssue = issueId
        $scope.data.title = 'Edit Issue'
        $('#formIssueModal').modal('show')
    }

    $scope.changeItemPerPage = () => {
        issueFactory.setConfig($scope.data)
    }

    $scope.changePage = (p) => {
        $scope.data.config.currentPage = p
        issueFactory.setConfig($scope.data)
    }

    $scope.fillerAll = () => {
        let start = $scope.data.startTime ? $scope.data.startTime.getTime() : ''
        let end = $scope.data.endTime ? $scope.data.endTime.getTime() : ''
        $scope.data.issues = $scope.data.issuesTemp
        $scope.data.issues = _.filter($scope.data.issues, (item) => {
            if((item.name.includes($scope.data.config.search) || item.descripttion.includes($scope.data.config.search))
            && (!$scope.data.status || ($scope.data.status == item.status_id))
            && (time = (new Date(item.deadline).getTime()))
            && (!start || (time >= start))
            && (!end || (time <= end))
            ) {
                return item
            }
        })
        issueFactory.setConfig($scope.data)
    }

    // $scope.fillerStatus = () => {
    //     $scope.data.issues = $scope.data.issuesTemp
    //     if($scope.data.status){
    //         console.log(123);
    //         $scope.data.issues = _.filter($scope.data.issues, (item) => {
    //             if($scope.data.status == item.status_id) {
    //                 return item
    //             }
    //         })
    //     }
    //     issueFactory.setConfig($scope.data)
    // }


    $scope.deleteIssue = (id) => {
        issueFactory.deleteIssue(id)
        .then((resp) => {
            alert('Xoá thành công')
        }).catch((err) => {
            alert(err.data)
        })
        issueFactory.getListIssue($scope.data)
    }


    issueFactory.getListIssue($scope.data)
    issueFactory.getListStatuses(1)
    .then((resp) => {
        $scope.data.statuses = resp.data
    }).catch((err) => {
        console.log(err)
    })
})

