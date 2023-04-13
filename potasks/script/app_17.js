apple.controller("nowtasks", [
    "$scope",
    "$http",
    "$filter",
    "$location",
    function ($scope, $http, $filter, $routeParams, $location, ) {
        $scope.tasks = {}
        $scope.tags = {}
        $scope.users = {}
        $scope.test = {}
        $scope.testtags = {}
        $scope.times = {}
        $scope.spend = {}
        $scope.timeperuid = {}
        $scope.spendperuid = {}
        $scope.timepertag = {}
        $scope.spendpertag = {}
        gettasks = function () {
            $scope.supertime=0
            $scope.superspend=0
            $scope.tasks = {}
            $scope.timeperuid = {}
            $scope.spendperuid = {}
            $scope.timepertag = {}
            angular.forEach($scope.tags, function (summ, tag) {
                $scope.tags[tag] = []
                $scope.testtags[tag] = 0
                $scope.timepertag[tag] = 0
                $scope.spendpertag[tag] = 0
            })
            $http.get("/potasks/potasks.json", {
                headers: {
                    "If-Modified-Since": "0",
                    Pragma: "no-cache",
                    Expires: -1,
                    "Cache-Control": "no-cache, no-store, must-revalidate"
                }
            }).then(function (response) {
                $scope.users = response.data.babies
                $scope.testtags['Не определено'] = 0
                $scope.timepertag['Не определено'] = 1
                angular.forEach(response.data.tasks, function (tasks, uid) {
                    $scope.tasks[uid] = {}
                    $scope.test[uid] = {}
                    $scope.times[uid] = {}
                    $scope.spend[uid] = {}
                    $scope.timeperuid[uid] = 0
                    $scope.spendperuid[uid] = 0
                    $scope.times[uid]['Не определено'] = 0
                    $scope.spend[uid]['Не определено'] = 0
                    $scope.test[uid]['Не определено'] = 0
                    angular.forEach(tasks, function (task, ndx) {
                        if (task.TAGS.length > 0) {
                            task.TIME_SPENT_IN_LOGS=+task.TIME_SPENT_IN_LOGS
                            angular.forEach(task.TAGS, function (tag, ndx1) {
                                !$scope.tasks[uid][tag] ? $scope.tasks[uid][tag] = [] : ''
                                $scope.tasks[uid][tag].push(task.ID);
                                !$scope.tags[tag] ? $scope.tags[tag] = [] : ''
                                $scope.tags[tag].push(task.ID) ;
                                !$scope.test[uid][tag] ? $scope.test[uid][tag] = 0 : '';
                                !$scope.times[uid][tag] ? $scope.times[uid][tag] = 0 : ''
                                $scope.times[uid][tag] = $scope.times[uid][tag] + task.TIME_ESTIMATE / task.TAGS.length
                                !$scope.spend[uid][tag] ? $scope.spend[uid][tag] = 0 : ''
                                $scope.spend[uid][tag] = $scope.spend[uid][tag] + task.TIME_SPENT_IN_LOGS / task.TAGS.length
                                $scope.timeperuid[uid] = $scope.timeperuid[uid] + task.TIME_ESTIMATE / task.TAGS.length
                                task.TIME_SPENT_IN_LOGS?$scope.spendperuid[uid] = $scope.spendperuid[uid] + task.TIME_SPENT_IN_LOGS / task.TAGS.length:''
                                $scope.test[uid][tag] = $scope.test[uid][tag] + 1 / task.TAGS.length;
                                !$scope.testtags[tag] ? $scope.testtags[tag] = 0 : '';
                                !$scope.timepertag[tag] ? $scope.timepertag[tag] = 0 : '';
                                !$scope.spendpertag[tag] ? $scope.spendpertag[tag] = 0 : '';
                                $scope.testtags[tag] = $scope.testtags[tag] + 1 / task.TAGS.length
                                $scope.timepertag[tag] = $scope.timepertag[tag] + task.TIME_ESTIMATE / task.TAGS.length
                                $scope.spendpertag[tag] = $scope.spendpertag[tag] + task.TIME_SPENT_IN_LOGS / task.TAGS.length
                            })
                        } else {
                            task.TIME_ESTIMATE = parseInt(task.TIME_ESTIMATE);
                            task.TIME_SPENT_IN_LOGS = +task.TIME_SPENT_IN_LOGS;
                            $scope.times[uid]['Не определено'] = $scope.times[uid]['Не определено'] + task.TIME_ESTIMATE
                            $scope.spend[uid]['Не определено'] = $scope.spend[uid]['Не определено'] + task.TIME_SPENT_IN_LOGS
                            $scope.timeperuid[uid] = $scope.timeperuid[uid] + task.TIME_ESTIMATE
                            $scope.spendperuid[uid] = $scope.spendperuid[uid] + task.TIME_SPENT_IN_LOGS
                            $scope.testtags['Не определено'] = $scope.testtags['Не определено'] + 1
                            $scope.timepertag['Не определено'] = +$scope.timepertag['Не определено'] + task.TIME_ESTIMATE
                            $scope.spendpertag['Не определено'] = +$scope.spendpertag['Не определено'] + task.TIME_SPENT_IN_LOGS
                            $scope.test[uid]['Не определено'] = $scope.test[uid]['Не определено'] + 1;
                            !$scope.tasks[uid]['Не определено'] ? $scope.tasks[uid]['Не определено'] = [] : ''
                            $scope.tasks[uid]['Не определено'].push(task.ID);
                            !$scope.tags['Не определено'] ? $scope.tags['Не определено'] = [] : ''
                            $scope.tags['Не определено'].push(task.ID)
                        }
                        console.log(task)
                    })
                })
                angular.forEach($scope.timepertag, function (time, tag) {
                    $scope.supertime =  $scope.supertime+time
                })
                angular.forEach($scope.spendpertag, function (time, tag) {
                   time?$scope.superspend =  $scope.superspend+time:''
                })
                //$scope.tags = $scope.tags.filter((x, i, a) => a.indexOf(x) == i)
            })
        }
        gettasks()
        setInterval(function () {
            gettasks()
        }, 5000)
    }])