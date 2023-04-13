let dates = {}
let updater
apple = angular.module("matrix", []);
apple.controller("matrix", [
    "$scope",
    "$http",
    "$filter",
    "$location",
    function ($scope, $http, $filter, $location,) {
        let source = "ittasks4.json"
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
        $('ul.tabs').tabs();
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
            $scope.details['name'] = $scope.users[uid].name
            $scope.details['tasks'] = $scope.full[uid]
            $('.collapsible').collapsible();
            $('#details').modal('open')
        }
        $scope.getdata = function () {
            clearInterval(updater)
            $scope.isloading = true
            $http.get("../returner/ittasks.php?mode=ittasks12&datefrom=" + $scope.datefrom + "&dateto=" + $scope.dateto, {
                headers: {
                    "If-Modified-Since": "0",
                    Pragma: "no-cache",
                    Expires: -1,
                    "Cache-Control": "no-cache, no-store, must-revalidate"
                }
            }).then(function (response) {
                $scope.isloading = false
                source = "ittasks_custom.json"
                $scope.supertotal = 0
                gettasks()
            })
        }
        gettasks = function () {
            $scope.deps = []
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
            $scope.supertime = 0
            $scope.superspend = 0
            $scope.full = {}
            $scope.tasks = {}
            $scope.timeperuid = {}
            $scope.spendperuid = {}
            $scope.timepertag = {}
            $scope.allservice = 0
            $scope.allcommerce = 0
            angular.forEach($scope.tags, function (summ, tag) {
                $scope.tags[tag] = []
                $scope.testtags[tag] = 0
                $scope.timepertag[tag] = 0
                $scope.spendpertag[tag] = 0
            })
            $http.get(source, {
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
                    $scope.full[uid] = tasks
                    $scope.test[uid] = {}
                    $scope.times[uid] = {}
                    $scope.spend[uid] = {}
                    $scope.timeperuid[uid] = 0
                    $scope.spendperuid[uid] = 0
                    $scope.times[uid]['Не определено'] = 0
                    $scope.spend[uid]['Не определено'] = 0
                    $scope.test[uid]['Не определено'] = 0

                   

                    angular.forEach(tasks, function (task, ndx) {
                        console.log(task.ID);
                        if (task.TAGS&&task.TAGS.length > 0) {
                            task.TIME_SPENT_IN_LOGS = +task.TIME_SPENT_IN_LOGS
                            const tags = task.TAGS
                             .filter(t => !t.includes("И"))
                            .filter(t => !t.includes("_ПРЯМОЕ_ОБРАЩЕНИЕ_"))
                             .filter(t => !t.includes("Колл-центр"))
                             .filter(t => !t.includes("Колл-Центр"))
                            .filter(t => !t.includes("Отдел продаж Пивко (Развитие Стандарт)"))
                            .filter(t => !t.includes("Пиццерии"))
                            .filter(t => !t.includes("Бухгалтерия"))
                            .filter(t => !t.includes("Базовая сеть Пивко"))
                            .filter(t => !t.includes("Эвертон Дрингс"))
                            .filter(t => !t.includes("_1"))
                            .filter(t => !t.includes("_2"))
                            .filter(t => !t.includes("Краснодар"))
                            .filter(t => !t.includes("Арамильская бойлерная пивоварня"))
                            .filter(t => !t.includes("УЕК"))
                            .filter(t => !t.includes("Привлечение (Развитие Профф)"))
                            .filter(t => !t.includes("Снековый завод Эвертон"))
                            .filter(t => !t.includes("СУУ"))
                            .filter(t => !t.includes("ВЭД"))
                            .filter(t => !t.includes("ОАО"))
                            .filter(t => !t.includes("Отдел персонала"))
                            .filter(t => !t.includes("Традиционный ОПТ"))
                            .filter(t => !t.includes("РЦ"))
                            .filter(t => !t.includes("ПО"))
                            .filter(t => !t.includes("Эвертон Полевой"))
                            .filter(t => !t.includes("СТОЛОВАЯ - Полевой"))
                            .filter(t => !t.includes("Оперативные Управляющие"))
                            .filter(t => !t.includes("Франшиза - ПРОФ"))
                            .filter(t => !t.includes("СБ ОПТ"))
                            .filter(t => !t.includes("_&"))
                            .filter(t => !t.includes("Сопровождение - Франшиза"))
                            if (tags.length) {
                                for (const tag of tags) {
                                    !$scope.tasks[uid][tag] ? $scope.tasks[uid][tag] = [] : ''
                                    $scope.tasks[uid][tag].push(task.ID);
                                    
                                    !$scope.tags[tag] ? $scope.tags[tag] = [] : ''
                                    $scope.tags[tag].push(task.ID);


                                    !$scope.test[uid][tag] ? $scope.test[uid][tag] = 0 : '';
                                    !$scope.times[uid][tag] ? $scope.times[uid][tag] = 0 : ''
                                    $scope.times[uid][tag] = $scope.times[uid][tag] + task.TIME_ESTIMATE / tags.length;
                                    !$scope.spend[uid][tag] ? $scope.spend[uid][tag] = 0 : ''
                                    $scope.spend[uid][tag] = $scope.spend[uid][tag] + task.TIME_SPENT_IN_LOGS / tags.length
                                    $scope.timeperuid[uid] = $scope.timeperuid[uid] + task.TIME_ESTIMATE / tags.length
                                    task.TIME_SPENT_IN_LOGS ? $scope.spendperuid[uid] = $scope.spendperuid[uid] + task.TIME_SPENT_IN_LOGS / tags.length : ''
                                    $scope.test[uid][tag] = $scope.test[uid][tag] + 1; // / tags.length - деление на тэги
                                    !$scope.testtags[tag] ? $scope.testtags[tag] = 0 : '';
                                    !$scope.timepertag[tag] ? $scope.timepertag[tag] = 0 : '';
                                    !$scope.spendpertag[tag] ? $scope.spendpertag[tag] = 0 : '';
                                    $scope.testtags[tag] = $scope.testtags[tag] + 1 // итог количество задач 
                                    $scope.timepertag[tag] = $scope.timepertag[tag] + task.TIME_ESTIMATE / tags.length
                                    $scope.spendpertag[tag] = $scope.spendpertag[tag] + task.TIME_SPENT_IN_LOGS / tags.length
                                }
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
                    })
                    
                })

               
                angular.forEach($scope.timepertag, function (time, tag) {
                    $scope.supertime = $scope.supertime + time
                })
                angular.forEach($scope.spendpertag, function (time, tag) {
                    time ? $scope.superspend = $scope.superspend + time : ''
                })
                //$scope.tags = $scope.tags.filter((x, i, a) => a.indexOf(x) == i)
                $scope.calccost()
            })
            // 
        }
        $scope.calccost = function () {
            let allhours = 0
            let commerce_summ = 0
            let service_summ = 0
            for (dep in $scope.spendpertag) {
                commerce_summ = commerce_summ + $scope.spendpertag[dep] / 60 / 60
                $scope.spendpertag[dep] ? allhours = $scope.spendpertag[dep] / 60 / 60 + allhours : ''
            }
            $scope.costperhour = $scope.expenses / allhours
            $scope.allcommerce = $scope.costperhour * commerce_summ
        }
        gettasks()
        updater = setInterval(() => gettasks(), 3000)
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
    }
])