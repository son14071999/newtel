const { data } = require("jquery")

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
                statuses: [],
                finishStatuses: [],

            }
            let processData = {
                'getListStatuses': () => {

                },
                'getListFinishStatus': () => {
                    
                }
            }
        }
    }
})
