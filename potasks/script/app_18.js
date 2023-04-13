let dates = {}
let updater
apple = angular.module("matrix", ["ngRoute"]);
apple.config(function ($locationProvider) {
    $locationProvider.html5Mode({
        enabled: true,
        requireBase: false
    });
})
apple.config(function ($routeProvider) {
    $routeProvider
        .when("/potasks", {
            controller: "matrix",
            templateUrl: "./potasks/app/index.html"
        })
        .when("/nowtasks", {
            controller: "nowtasks",
            templateUrl: "./potasks/app/nowtasks.html"
        })
        .when("/tasktest", {
            controller: "tasktest",
            templateUrl: "./potasks/app/tasktest.html"
        })
});
apple.controller("matrix", [
    "$scope",
    "$http",
    "$filter",
    "$location",
    function ($scope, $http, $filter, $routeParams, $location,) {
        let source = "potasks/potasks4.json"
        const exeptTags = ["_", "_ADT"]
        $scope.tasks = {}
        $scope.details = {}
        $scope.tags = {}
        $scope.full = {}
        $scope.datefrom = ''
        $scope.dateto = ''
        $scope.users = {}
        $scope.test = {}
        $scope.testtags = {}
        $scope.times = {}
        $scope.spend = {}
        $scope.timeperuid = {}
        $scope.spendperuid = {}
        $scope.timepertag = {}
        $scope.spendpertag = {}
        $scope.isloading = false
        $scope.expenses = 0
        $scope.costperhour = 0
        $scope.allhours = 0
        $scope.totals = {}
        $scope.mytag = ""
        $scope.onlycomplete = false
        $scope.filterTasks = () => filterTasks()
        $scope.SpecialTags = [
            { tag: "Управляющая компания (Инвест)", quota: 0.3 },
            { tag: "Базовая сеть Пивко", quota: 0.7 },
        ]
        let Response = {}
        $('.modal').modal();
        $('#nav-mobile').sidenav({
            edge: 'left', // Choose the horizontal origin
            closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
            draggable: true
        });
        $('.datepicker').datepicker({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15, // Creates a dropdown of 15 years to control year,
            today: 'Сегодня',
            clear: 'Очистить',
            format: 'yyyy-mm-dd',
            close: 'Ok',
            firstDay: 1,
            i18n: {
                today: 'Сегодня',
                clear: 'Очистить',
                cancel: 'Отмена',
                months: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                monthsShort: ['Янв', 'Фев', 'Март', 'Апр', 'Май', 'Июнь', 'Июль', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
                weekdays: ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббот', 'Воскресенье'],
                weekdaysShort: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                weekdaysAbbrev: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб']
            },
            onSelect: function () {
                let date = new Date();
                date.setTime(this.date);
                let month = date.getMonth() + 1
                let obj = this.$el[0]
                let id = $(obj).attr('id')
                let day = date.getDate()
                if (month < 10)
                    month = "0" + month;
                if (day < 10)
                    day = "0" + day;
                date = date.getFullYear() + "-" + month + "-" + day;
                dates[id] = date
                updatedates()
            },
            showMonthsShort: true,
            closeOnSelect: false, // Close upon selecting a date,
            container: 'body' // ex. 'body' will append picker to body
        });
        updatedates = function () {
            for (let ndx in dates) {
                switch (ndx) {
                    case 'dateto':
                        $scope.dateto = dates[ndx]
                        break
                    case 'datefrom':
                        $scope.datefrom = dates[ndx]
                        break
                }
            }
        }
        $scope.beautydate = function (date) {
            return date.split("T")[0]
        }
        $scope.opendetails = function (uid) {
            $scope.details['tasks'] = {}
            $scope.details['name'] = $scope.users[uid].name
            if ($scope.full[uid]) Object.values($scope.full[uid]).forEach(task => {
                if (task.ID) $scope.details['tasks'][task.ID] = task
            })
            $('.collapsible').collapsible();
            $('#details').modal('open')
        }
        $scope.getdata = async function () {
            $('ul.tabs').tabs();
            clearInterval(updater)
            $scope.isloading = true
            await $http.get("../returner/tasks.php?mode=potasks12&datefrom=" + $scope.datefrom + "&dateto=" + $scope.dateto + "&mytag=" + $scope.mytag, {
                headers: {
                    "If-Modified-Since": "0",
                    Pragma: "no-cache",
                    Expires: -1,
                    "Cache-Control": "no-cache, no-store, must-revalidate"
                }
            })
            $scope.isloading = false
            source = "potasks/potasks_custom.json"
            gettasks()
        }
        let lasthash = ""
        const filterTasks = () => {

            const { tasks, babies } = Response.data
            const allTasks = [].concat(...Object.values(tasks).map(ts => Object.values(ts)))

            allTasks.forEach(task => {
                task.TAGS = task.TAGS.filter(t => !t.includes("%"))
            })
            const AllTags = [...new Set([].concat(...allTasks.map(task => task.TAGS)))]

            //const RealTags = AllTags.filter(t => !t.includes("_"))
            // const HiddenTags = AllTags.filter(t => t.includes("_"))
            const TasksNoTags = allTasks.filter(t => !t.TAGS.length)
            /* 
                        const calcCell=(uid,tag)=>{
                            return
                        }
            */
            $scope.totals = {}
            $scope.supertotal2 = 0
            $scope.deps = []
            $scope.table = {}
            $scope.supertime = 0
            $scope.superspend = 0
            $scope.full = {}
            $scope.tasks = {}
            $scope.timeperuid = {}
            $scope.spendperuid = {}
            $scope.timepertag = {}
            $scope.allservice = 0
            $scope.allcommerce = 0
            $scope.deps['service'] = [
                "Единая концепция",
                "Бухгалтерия",
                "РЦ",
                "ПО",
                "УРЗИЗ",
                "СБ ОПТ",
                "СУУ",
                "Отдел персонала",
                "Стройка",
                "ИТ",
                "ТехСлужба",
                "УКИК"
            ]
            $scope.deps['commerce'] = [
                "Розница",
                "Italian пицца",
                "Бар-маркет",
                "Франшиза",
                "МиниПивоварня",
                "ОПТ",
                "Эвертон",
                "ПиццаМаркет"
            ]
            angular.forEach($scope.tags, function (summ, tag) {
                $scope.tags[tag] = []
                $scope.testtags[tag] = 0
                $scope.timepertag[tag] = 0
                $scope.spendpertag[tag] = 0
            })
            $scope.users = Response.data.babies
            $scope.testtags['Не определено'] = 0
            $scope.timepertag['Не определено'] = 1
            $scope.ST = {}



            angular.forEach(Response.data.tasks, function (tasks, uid) {

                const t = Object.values(tasks).filter(t => $scope.onlycomplete ? t.REAL_STATUS == '4' : t.REAL_STATUS)


                $scope.tasks[uid] = {}
                $scope.full[uid] = tasks
                $scope.test[uid] = {}
                $scope.times[uid] = {}
                $scope.spend[uid] = {};
                if (!$scope.table[uid]) $scope.table[uid] = []
                !$scope.totals[uid] ? $scope.totals[uid] = 0 : ''
                $scope.timeperuid[uid] = 0
                $scope.spendperuid[uid] = 0
                $scope.times[uid]['Не определено'] = 0
                $scope.spend[uid]['Не определено'] = 0
                $scope.test[uid]['Не определено'] = 0



                for (const task of t) {
                    if (task.TAGS && task.TAGS.length) {
                        task.TIME_SPENT_IN_LOGS = +task.TIME_SPENT_IN_LOGS
                        const tags = task.TAGS.filter(t => !t.includes("%") || !t.includes("_%"))
                        const mytags = task.TAGS.filter(t => t.includes("%") || t.includes("_%"))
                        if (tags.length) {
                            for (const tag of tags) {
                                !$scope.tasks[uid][tag] ? $scope.tasks[uid][tag] = [] : ''
                                $scope.tasks[uid][tag].push(task.ID);
                                !$scope.tags[tag] ? $scope.tags[tag] = [] : ''
                                $scope.tags[tag].push(task.ID);
                                !$scope.test[uid][tag] ? $scope.test[uid][tag] = 0 : '';
                                !$scope.times[uid][tag] ? $scope.times[uid][tag] = 0 : ''
                                //$scope.times[uid][tag] = $scope.times[uid][tag] + task.TIME_ESTIMATE / tags.length;
                                $scope.times[uid][tag] = $scope.times[uid][tag] + calcSpecial(task.TIME_ESTIMATE, tags, task)[tag]
                                !$scope.spend[uid][tag] ? $scope.spend[uid][tag] = 0 : ''
                                //$scope.spend[uid][tag] = $scope.spend[uid][tag] + task.TIME_SPENT_IN_LOGS / tags.length
                                $scope.spend[uid][tag] = $scope.spend[uid][tag] + calcSpecial(task.TIME_SPENT_IN_LOGS, tags, task)[tag]
                                // $scope.timeperuid[uid] = $scope.timeperuid[uid] + task.TIME_ESTIMATE / tags.length
                                $scope.timeperuid[uid] = $scope.timeperuid[uid] + calcSpecial(task.TIME_ESTIMATE, tags, task)[tag]
                                // task.TIME_SPENT_IN_LOGS ? $scope.spendperuid[uid] = $scope.spendperuid[uid] + task.TIME_SPENT_IN_LOGS / tags.length : ''
                                task.TIME_SPENT_IN_LOGS ? $scope.spendperuid[uid] = $scope.spendperuid[uid] + calcSpecial(task.TIME_SPENT_IN_LOGS, tags, task)[tag] : ''
                                // $scope.test[uid][tag] = $scope.test[uid][tag] + 1 / tags.length;
                                $scope.test[uid][tag] = calcSpecial(($scope.test[uid][tag] + 1), tags, task)[tag]
                                !$scope.testtags[tag] ? $scope.testtags[tag] = 0 : '';
                                !$scope.timepertag[tag] ? $scope.timepertag[tag] = 0 : '';
                                !$scope.spendpertag[tag] ? $scope.spendpertag[tag] = 0 : '';
                                // $scope.testtags[tag] = $scope.testtags[tag] + 1 / tags.length
                                $scope.testtags[tag] = calcSpecial(($scope.testtags[tag] + 1), tags, task)[tag]
                                //$scope.timepertag[tag] = $scope.timepertag[tag] + task.TIME_ESTIMATE / tags.length
                                //$scope.spendpertag[tag] = $scope.spendpertag[tag] + task.TIME_SPENT_IN_LOGS / tags.length
                                $scope.timepertag[tag] = $scope.timepertag[tag] + calcSpecial(task.TIME_ESTIMATE, tags, task)[tag]
                                $scope.spendpertag[tag] = $scope.spendpertag[tag] + calcSpecial(task.TIME_SPENT_IN_LOGS, tags, task)[tag]
                            }
                        } else if (!$scope.mytag) {
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
                    } else if (!$scope.mytag) {
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
                }
            })
            angular.forEach($scope.timepertag, function (time, tag) {
                $scope.supertime = $scope.supertime + time
            })
            angular.forEach($scope.spendpertag, function (time, tag) {
                time ? $scope.superspend = $scope.superspend + time : ''
            })
            //$scope.tags = $scope.tags.filter((x, i, a) => a.indexOf(x) == i)
            $('ul.tabs').tabs();
            $scope.calccost()
            setTimeout(() => {
                $scope.table['head'] = []
                Object.keys($scope.table).forEach(uid => {
                    if ($scope.test[uid]) {
                        Object.keys($scope.tags).forEach(tag => {
                            if (!$scope.table['head'].includes(tag)) {
                                $scope.table['head'].push(tag)
                                $scope.table['head'].push(tag)
                            }
                            if ($scope.test[uid][tag]) {
                                $scope.table[uid].push(($scope.test[uid][tag].toFixed(1)).replace(".", ","))
                            } else {
                                $scope.table[uid].push("0,0")
                            }
                            if ($scope.test[uid][tag]) {
                                $scope.table[uid].push(($scope.spend[uid][tag] / 60 / 60).toFixed(1).replace(".", ","))
                            } else {
                                $scope.table[uid].push("0,0")
                            }
                        })
                        // $scope.table[uid] = $scope.table[uid].filter(v => v > 0)
                    }
                })
                Object.values($scope.testtags).forEach(tag => $scope.supertotal2 = $scope.supertotal2 + tag)
                $scope.$apply()
                M.updateTextFields();
            }, 250);
            Object.keys($scope.tasks).forEach(uid => {
                !$scope.totals[uid] ? $scope.totals[uid] = [] : ''
                Object.values($scope.tasks[uid]).forEach(p => p.forEach(tid => !$scope.totals[uid].includes(tid) && $scope.totals[uid].push(tid)))
            })
        }
        gettasks = async function () {
            Response = await $http.get(source, {
                /*  headers: {
                     "If-Modified-Since": "0", Pragma: "no-cache", Expires: -1, "Cache-Control": "no-cache, no-store, must-revalidate"
                 } */
            })
            const hash = CryptoJS.MD5(JSON.stringify(Response)).toString()
            if (lasthash == hash) return
            lasthash = hash
            filterTasks()
        }
        $scope.calccost = function () {
            $scope.allhours = 0
            let commerce_summ = 0
            let service_summ = 0
            for (dep in $scope.spendpertag) {
                commerce_summ = commerce_summ + $scope.spendpertag[dep] / 60 / 60
                $scope.spendpertag[dep] ? $scope.allhours = $scope.spendpertag[dep] / 60 / 60 + $scope.allhours : ''
            }
            $scope.costperhour = $scope.expenses / $scope.allhours
            $scope.allcommerce = $scope.costperhour * commerce_summ
        }
        /*     $scope.calccost = function () {
                let allhours = 0
                let commerce_summ = 0
                let service_summ = 0
                for (dep in $scope.spendpertag) {
                    $scope.deps['commerce'].indexOf(dep) + 1 > 0 ? commerce_summ = commerce_summ + $scope.spendpertag[dep] / 60 / 60 : service_summ = service_summ + $scope.spendpertag[dep] / 60 / 60
                    allhours = $scope.spendpertag[dep] / 60 / 60 + allhours
                }
                $scope.costperhour = $scope.expenses / allhours
                $scope.all_commerce = commerce_summ * $scope.costperhour
                $scope.all_service = service_summ * $scope.costperhour
            } */
        gettasks()
       updater = setInterval(() => gettasks(), 3000)
       $scope.toexcel = () => {
            $("table#statistics").table2excel({
                name: "PO Statistics",
                filename: "statistics2",
                fileext: ".xls",
                exclude_img:  true,
                exclude_links: true,
                exclude_inputs: true
            });
        }
        $scope.toexcelUser = () => {
            $("table#employee_excel").table2excel({
                name: "PO Statistics",
                filename: "statisticsUser",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        }
        const calcSpecial = (param, tags, task = {}) => {
            const result = { all: param }
            tags = tags.map(t => t.trim())
            const sp = $scope.SpecialTags.map(t => t.tag)
            const inarray = sp.filter(s => tags.includes(s))
            if (inarray.length == $scope.SpecialTags.length) {
                result['special'] = true
                let ent = 0
                const other = tags.filter(t => !sp.includes(t))
                if (other.length) other.forEach(t => {
                    result[t] = param / tags.length
                    ent += param / tags.length
                })
                $scope.SpecialTags.forEach(sp => result[sp.tag] = (param - ent) * sp.quota)
                if (task.ID) {
                    const calcitem = {}
                    calcitem['task'] = task
                    calcitem['calc'] = result
                    $scope.ST[task.TITLE] = calcitem
                }
                const resultOld = []
                tags.forEach(t => {
                    resultOld[t] = param / tags.length
                })
            } else {
                tags.forEach(t => {
                    result[t] = param / tags.length
                })
            }
            return result
        }
    }
])