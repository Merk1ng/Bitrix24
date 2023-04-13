<?php
/* error_reporting(E_ALL);
ini_set('display_errors', 1); */
header('Content-Type: text/json; charset=utf-8');
$month = (date('m') - 0) < 10 ? '0' . (date('m') - 2) : (date('m') - 2);
$year = date('Y');
$mode = $_GET['mode'] ? $_GET['mode'] : $_SERVER['argv'][1];
$datefrom = $_GET['datefrom'];
$dateto = $_GET['dateto'];
$babies = [
    //3542 => ['name' => 'Шартдинов Роман'],
    // 2526 => ['name' => 'Натали'],
    //1832 => ['name' => 'Петров Александр'],
    //2222 => ['name' => 'Семенов Евгений'],
    //3448 => ['name' => 'Цыганов Никита'],
    //3590 => ['name' => 'Лямкина Юлия'],
    //3788 => ['name' => 'Милорадов Александр']
    //12 => ['name' => 'Юртаев Вячеслав'],
    //5608 => ['name' => 'Юренков Михаил'],
    //678 => ['name' => 'Захаров Александр'],
    3494 => ['name' => 'Пустосмехов Дмитрий'],
    6968 => ['name' => 'Деханов Александр'],
    //6970 => ['name' => 'Хазиева Владлена'],
    7416 => ['name' => 'Иванов Дмитрий'],
    9066 => ['name' => 'Чебыкина Ульяна'],
    11988 => ['name' => 'Грицай Оксана'],
    11944 => ['name' => 'Сотников Никита'],
    12074 => ['name' => 'Медовщиков Дмитрий'],
    12802 => ['name' => 'Морозов Даниил'],
    //13320 => ['name' => 'Литвинов Артем'],


    // 3822 => ['name' => 'Пул задач'],
];
switch ($mode) {
    

    case 'ittasks11':
        include 'clss.php';
        $load = new CLoader();
        $start = microtime(true);
        $method2 = "task.elapseditem.getlist";
        // $params2['ORDER'] = ["ID" => "DESC"];
        //  $params2['FILTER'] = ['USER_ID' =>array_keys($babies), '>CREATED_DATE' => "2019-" . $month . "-01"];
        $ids = [];
        $count = 2000;
        $rounds = ceil($count / 50);

        $rdate = $year."-" . $month . "-31";

        for ($i = 0; $i < $rounds; $i++) {
            $appParams = array(
                "ORDER" => array("ID" => "DESC"), // Сортировка по ID - по убыванию
                "FILTER" => ['USER_ID' => array_keys($babies), '>CREATED_DATE' => $rdate], // Фильтр
                "SELECT" => array('*'), // Выборка - только ID записи и задачи
                "PARAMS" => array('NAV_PARAMS' => array( // Постраничка
                    "nPageSize" => 50, // по 50 элемента на странице
                    'iNumPage' => $i, // страница номер i
                )),
            );
            $rz = (array) $load->getbtasks($method2, $appParams);
            foreach ($rz['result'] as $log) {
                $logs[$log->ID] = $log;
                $ids[] = $log->TASK_ID;
            }
        }

      

        $ids = array_values(array_unique($ids));

        $parts = array_chunk($ids, 50);
        $method1 = "task.item.list";
        //$method1 = "tasks.task.list";
        foreach ($parts as $ndx => $part) {
            $params1['ORDER'] = ['ID' => 'desc'];
            $params1['FILTER'] = ['ID' => $part];
            $params1['PARAMS'] = ['LOAD_TAGS' => "Y"];
            $params1['SELECT'] = ['TITLE', 'RESPONSIBLE_ID', 'TAGS', 'CREATED_DATE', 'TIME_SPENT_IN_LOGS', 'ID'];

            $rz = (array) $load->getbtasks($method1, $params1)->result;
            foreach ($rz as $task) {

                unset($task->ALLOWED_ACTIONS);
                unset($task->CREATED_BY);
                unset($task->REAL_STATUS);
                unset($task->STATUS);
                unset($task->GROUP_ID);

                //!$result[$task->RESPONSIBLE_ID] ? $result[$task->RESPONSIBLE_ID] = [] : null;
                $result[$task->ID] = $task;
            }

        }

        // print_r($result);

        foreach ($logs as $nd1 => $log) {
            !array_key_exists($log->USER_ID, $times) ? $times[$log->USER_ID] = [] : null;
            !array_key_exists($log->TASK_ID, $times[$log->USER_ID]) ? $times[$log->USER_ID][$log->TASK_ID] = [] : null;
            !array_key_exists('LOGS', $times[$log->USER_ID][$log->TASK_ID]) ? $times[$log->USER_ID][$log->TASK_ID]['LOGS'] = [] : null;
            //!array_key_exists('TASK',$times[$log->USER_ID][$log->TASK_ID])?$times[$log->USER_ID][$log->TASK_ID]['TASK']=[]:null;
            $times[$log->USER_ID][$log->TASK_ID]['TIME_SPENT_IN_LOGS'] = $times[$log->USER_ID][$log->TASK_ID]['TIME_SPENT_IN_LOGS'] + $log->SECONDS;
            $times[$log->USER_ID][$log->TASK_ID]['LOGS'][$log->ID] = $log;
        }

        //   print_r($times);

        foreach ($times as $rid => $man) {
            foreach ($man as $tid => $log) {

                $result2['tasks'][$rid][$tid]['ID'] = $result[$tid]->ID;
                $result2['tasks'][$rid][$tid]['TITLE'] = $result[$tid]->TITLE;
                $result2['tasks'][$rid][$tid]['TAGS'] = $result[$tid]->TAGS;
                $result2['tasks'][$rid][$tid]['RESPONSIBLE_ID'] = $result[$tid]->RESPONSIBLE_ID;
                $result2['tasks'][$rid][$tid]['CREATED_DATE'] = $result[$tid]->CREATED_DATE;
                $result2['tasks'][$rid][$tid]['LOGS'] = $log['LOGS'];
                $result2['tasks'][$rid][$tid]['TIME_SPENT_IN_LOGS'] = $log['TIME_SPENT_IN_LOGS'];
            }
        }
        $result2['babies'] = $babies;
     
        file_put_contents('/var/www/html/ittasks/ittasks4.json', json_encode($result2, JSON_UNESCAPED_UNICODE));
        break;
    case 'ittasks12':
        if ($datefrom and $dateto) {
            include 'clss.php';
            $load = new CLoader();
            $start = microtime(true);
            $method2 = "task.elapseditem.getlist";
            // $params2['ORDER'] = ["ID" => "DESC"];
            //  $params2['FILTER'] = ['USER_ID' =>array_keys($babies), '>CREATED_DATE' => "2019-" . $month . "-01"];
            $ids = [];
            $count = 2000;
            $rounds = ceil($count / 50);
            for ($i = 0; $i < $rounds; $i++) {
                $appParams = array(
                    "ORDER" => array("ID" => "DESC"), // Сортировка по ID - по убыванию
                    "FILTER" => ['USER_ID' => array_keys($babies), '>CREATED_DATE' => $datefrom, '<CREATED_DATE' => $dateto], // Фильтр
                    "SELECT" => array('*'), // Выборка - только ID записи и задачи
                    "PARAMS" => array('NAV_PARAMS' => array( // Постраничка
                        "nPageSize" => 50, // по 50 элемента на странице
                        'iNumPage' => $i, // страница номер i
                    )),
                );
                $rz = (array) $load->getbtasks($method2, $appParams);
                foreach ($rz['result'] as $log) {
                    $logs[$log->ID] = $log;
                    $ids[] = $log->TASK_ID;
                }
            }
            $ids = array_values(array_unique($ids));

            $parts = array_chunk($ids, 50);
            $method1 = "task.item.list";
            //$method1 = "tasks.task.list";
            foreach ($parts as $ndx => $part) {
                $params1['ORDER'] = ['ID' => 'desc'];
                $params1['FILTER'] = ['ID' => $part];
                $params1['PARAMS'] = ['LOAD_TAGS' => "Y"];
                $params1['SELECT'] = ['TITLE', 'RESPONSIBLE_ID', 'TAGS', 'CREATED_DATE', 'TIME_SPENT_IN_LOGS', 'ID'];

                $rz = (array) $load->getbtasks($method1, $params1)->result;
                foreach ($rz as $task) {

                    unset($task->ALLOWED_ACTIONS);
                    unset($task->CREATED_BY);
                    unset($task->REAL_STATUS);
                    unset($task->STATUS);
                    unset($task->GROUP_ID);

                    //!$result[$task->RESPONSIBLE_ID] ? $result[$task->RESPONSIBLE_ID] = [] : null;
                    $result[$task->ID] = $task;
                }

            }

            // print_r($result);
            $times=[];
            foreach ($logs as $nd1 => $log) {
                !array_key_exists($log->USER_ID, $times) ? $times[$log->USER_ID] = [] : null;
                !array_key_exists($log->TASK_ID, $times[$log->USER_ID]) ? $times[$log->USER_ID][$log->TASK_ID] = [] : null;
                !array_key_exists('LOGS', $times[$log->USER_ID][$log->TASK_ID]) ? $times[$log->USER_ID][$log->TASK_ID]['LOGS'] = [] : null;
                //!array_key_exists('TASK',$times[$log->USER_ID][$log->TASK_ID])?$times[$log->USER_ID][$log->TASK_ID]['TASK']=[]:null;
                $times[$log->USER_ID][$log->TASK_ID]['TIME_SPENT_IN_LOGS'] = $times[$log->USER_ID][$log->TASK_ID]['TIME_SPENT_IN_LOGS'] + $log->SECONDS;
                $times[$log->USER_ID][$log->TASK_ID]['LOGS'][$log->ID] = $log;
            }

            //   print_r($times);

            foreach ($times as $rid => $man) {
                foreach ($man as $tid => $log) {

                    $result2['tasks'][$rid][$tid]['ID'] = $result[$tid]->ID;
                    $result2['tasks'][$rid][$tid]['TITLE'] = $result[$tid]->TITLE;
                    $result2['tasks'][$rid][$tid]['TAGS'] = $result[$tid]->TAGS;
                    $result2['tasks'][$rid][$tid]['RESPONSIBLE_ID'] = $result[$tid]->RESPONSIBLE_ID;
                    $result2['tasks'][$rid][$tid]['CREATED_DATE'] = $result[$tid]->CREATED_DATE;
                    $result2['tasks'][$rid][$tid]['LOGS'] = $log['LOGS'];
                    $result2['tasks'][$rid][$tid]['TIME_SPENT_IN_LOGS'] = $log['TIME_SPENT_IN_LOGS'];
                }
            }
            $result2['babies'] = $babies;
            print_r($result2);
            file_put_contents('/var/www/html/ittasks/ittasks_custom.json', json_encode($result2, JSON_UNESCAPED_UNICODE));
        }

        break;

}
