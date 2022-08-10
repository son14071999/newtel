app.directive('formIssue', function (issueFactory) {
    return {
        restrict: 'E',
        templateUrl: rootUrl + 'formIssue',
        scope: {
            issueId: "=",
            title: '='
        },
        link: function (scope, element, attrs) {
            scope.data = {
                employees : [],
                statuses: [],
                finishStatuses: [],
                issueInfo: [],
                config: {
                    itemPerPage: 1,
                    pageCurrent: 1,
                    pages: 1
                },
                parameters: {}

            }
            scope.configDefault = {
                'name': {
                    show: true,
                    disabled: false
                },
                'descripttion': {
                    show: true,
                    disabled: false
                },
                'jobAssignor_id': {
                    show: true,
                    disabled: false
                },
                'status_id': {
                    show: false,
                    disabled: true
                },
                'deadline': {
                    show: true,
                    disabled: false
                },
                'finishDay': {
                    show: false,
                    disabled: true
                },
                'status_finish_id': {
                    show: false,
                    disabled: true
                }
            }
            scope.config = {
                'name': {
                    show: true,
                    disabled: false
                },
                'descripttion': {
                    show: true,
                    disabled: false
                },
                'jobAssignor_id': {
                    show: true,
                    disabled: false
                },
                'status_id': {
                    show: false,
                    disabled: true
                },
                'deadline': {
                    show: true,
                    disabled: false
                },
                'finishDay': {
                    show: false,
                    disabled: true
                },
                'status_finish_id': {
                    show: false,
                    disabled: true
                }
            }
            let processData = {
                getListStatuses: () => {
                    issueFactory.getListStatuses(1)
                        .then((resp) => {
                            scope.data.statuses = resp.data
                        }).catch((err) => {
                            console.log(err)
                        })
                },
                getListFinishStatus: () => {
                    issueFactory.getListStatuses(2)
                        .then((resp) => {
                            scope.data.finishStatuses = resp.data
                        }).catch((err) => {
                            console.log(err)
                        })
                },
                getListUser: () => {
                    issueFactory.getListUser()
                    .then((resp) => {
                        scope.data.employees = resp.data.users.data
                    }).catch((err) => {
                        console.log(err)
                    })

                }
            }
            scope.saveIssue = () => {
                scope.data.parameters = scope.data.issueInfo
                console.log('scope.data.parameters: ', scope.data.parameters)
                issueFactory.saveIssue(scope.data)
                // .then((resp) => {
                //     log('rép: ', resp)
                // }).catch((err) => {
                //     log('err: ', err)
                // })
                // $('#formIssueModal').modal('hide')
            }

            scope.$watch('issueId', (newVal, oldVal) => {
                if (Number(newVal) <= 0) {
                    scope.config = scope.configDefault
                }
            })
            processData.getListStatuses()
            processData.getListFinishStatus()
            processData.getListUser()
        }
    }
})
