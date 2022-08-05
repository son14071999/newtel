app.directive('formIssue', function (issueFactory) {
    let link = function (scope, element, attrs) {
        
    };
    return {
        restrict: 'E',
        templateUrl: rootUrl + 'formIssue',
        scope: {
            issueId: "=",
            title: '='
        },
        link: link
    }
})
