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
                userId: 0,
                employees: [],
                statuses: [],
                finishStatuses: [],
                issueInfo: {},
                config: {
                    itemPerPage: 1,
                    pageCurrent: 5,
                    pages: 1,
                    currentPage: 1
                }
            }
            scope.configAdd = {
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
                }
            }
            scope.configExecutor = {
                'name': {
                    show: true,
                    disabled: true
                },
                'descripttion': {
                    show: true,
                    disabled: true
                },
                'executor_id': {
                    show: true,
                    disabled: true
                },
                'status_id': {
                    show: true,
                    disabled: false
                },
                'deadline': {
                    show: true,
                    disabled: true
                },
                'finishDay': {
                    show: true,
                    disabled: true
                }
            }
            scope.configJobAssignor = {
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
                    show: true,
                    disabled: true
                },

            }
            scope.config = {}
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
                if (Number(scope.issueId) <= 0) {
                    issueFactory.saveIssue(scope.data.issueInfo)
                        .then((resp) => {
                            alert('Thành công')
                        }).catch((err) => {
                            log('err: ', err)
                        })
                } else {
                    issueFactory.editIssue(scope.data.issueInfo, scope.issueId)
                        .then((resp) => {
                            console.log(resp)
                        }).catch((err) => {
                            console.log(err)
                        })
                }
                issueFactory.getListIssue(scope.inputData)
                $('#formIssueModal').modal('hide')
            }

            scope.$watch('issueId', (newVal, oldVal) => {
                if (Number(newVal) <= 0) {
                    scope.data.issueInfo = {}
                    scope.config = scope.configAdd
                } else {
                    issueFactory.getIssue(newVal)
                        .then((resp) => {
                            resp.data.info.deadline = resp.data.info.deadline ? new Date(resp.data.info.deadline) : ''
                            resp.data.info.finishDay = resp.data.info.finishDay ? new Date(resp.data.info.finishDay) : ''
                            scope.data.issueInfo = resp.data.info
                            scope.data.userId = resp.data.userId
                            if (scope.data.userId == scope.data.issueInfo.jobAssignor_id &&
                                scope.data.userId == scope.data.issueInfo.executor_id) {
                                scope.config = scope.configJobAssignor
                                scope.config.status_id.disabled = false
                                console.log(scope.configJobAssignor)
                            } else if (scope.data.userId == scope.data.issueInfo.jobAssignor_id) {
                                scope.config = scope.configJobAssignor
                            } else if (scope.data.userId == scope.data.issueInfo.executor_id) {
                                scope.config = scope.configExecutor
                            }
                        }).catch((err) => {
                            console.log(err)
                        })
                }
            })
            processData.getListStatuses()
            processData.getListFinishStatus()
            processData.getListUser()
        }
    }
})
