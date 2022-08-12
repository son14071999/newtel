app.directive('formIssue', function (issueFactory) {
    return {
        restrict: 'E',
        templateUrl: rootUrl + 'formIssue',
        scope: {
            issueId: "=",
            title: '=',
            inputData: "="
        },
        link: function (scope, element, attrs) {
            scope.data = {
                employees : [],
                statuses: [],
                finishStatuses: [],
                issueInfo: [],
                config: {
                    itemPerPage: 1,
                    pageCurrent: 5,
                    pages: 1,
                    currentPage: 1
                }
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
                'executor_id': {
                    show: true,
                    disabled: false
                },
                'status_id': {
                    show: true,
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
                'executor_id': {
                    show: true,
                    disabled: false
                },
                'status_id': {
                    show: true,
                    disabled: false
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
                .then((resp) => {
                    alert('Thành công')
                }).catch((err) => {
                    log('err: ', err)
                })
                issueFactory.getListIssue(scope.inputData)
                $('#formIssueModal').modal('hide')
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
