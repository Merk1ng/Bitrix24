<?php
/* error_reporting(E_ALL);
ini_set('display_errors', 1); */
header('Content-Type: text/json; charset=utf-8');
echo $month = (date('m') - 0) < 10 ? '0' . (date('m') - 0) : (date('m') - 0);
//$month = '04';
$mode = $_GET['mode'] ? $_GET['mode'] : $_SERVER['argv'][1];
$datefrom = $_GET['datefrom'];
$dateto = $_GET['dateto'];
$mytag = $_GET['mytag'];
$babies = [
    //3542 => ['name' => 'Шартдинов Роман'],
    // 2526 => ['name' => 'Натали'],
    //2138 => ['name' => 'Степанов Дмитрий'],
    1832 => ['name' => 'Петров Александр'],
    //2222 => ['name' => 'Семенов Евгений'],
    //3448 => ['name' => 'Цыганов Никита'],
    //3590 => ['name' => 'Лямкина Юлия'],
    //3788 => ['name' => 'Милорадов Александр']
    2526 => ['name' => 'Натали'],
    //3542 => ['name' => 'Шартдинов Роман'],
    //1832 => ['name' => 'Петров Александр'],
    5074 => ['name' => 'Долматов Виталий'],
    // 2138 => ['name' => 'Степанов Дмитрий'],
    3448 => ['name' => 'Цыганов Никита'],
    // 3590 => ['name' => 'Лямкина Юлия'],
    // 4766 => ['name' => 'Колясников Дмитрий'],
    //4778 => ['name' => 'Аутсорсер'],
    5702 => ['name' => 'Григорьев Вениамин'],
    7572 => ['name' => 'Неймышев Станислав'],
    //4808 => ['name' => 'Кузнецов Иван'],
    4842 => ['name' => 'Анисимов Сергей'],
    //6890 => ['name' => 'Колодкина Ксю'],
    8080 => ['name' => 'Васильев Денис'],
    8078 => ['name' => 'Дмитриева Екатерина'],
    8048 => ['name' => 'Серебряков Александр'],
    //8550 => ['name' => 'Грохотов Александр'],
    7760 => ['name' => 'Аутсорс'],
    //8876 => ['name' => 'Серенков Сергей'],
    9908 => ['name' => 'Гусев Александр'],
    9630 => ['name' => 'Загорский Сергей'],
    10460 => ['name' => 'Егоров Иван'],
    10156 => ['name' => 'Матюшкина Ульяна'],
    10776 => ['name' => 'Шагивалеев Виталий'],
    234 => ['name' => 'Сидельников Артем'],
    9948 => ['name' => 'Калегин Сергей'],
    11538 => ['name' => 'Зорков Константин'],
    15482 => ['name' => 'Дубских Анастасия'],

//3158 => ['name' => 'Чагин Сергей'],
    // 3822 => ['name' => 'Пул задач'],
];
switch ($mode) {
    case 'potasks':
        include 'clss.php';
        $load = new CLoader();
///usr/bin/php /home/u59462/mcrm.pivzavoz24.ru/www/tasks.php?mode=potasks&token=27erabul
        $result = [];
        $babies['3822'] = ['name' => 'Пул задач'];
        $result['babies'] = $babies;
        foreach ($babies as $rid => $baby) {
            $method1 = 'task.item.list';
            $params1['ORDER'] = ['RESPONSIBLE_ID' => 'desc'];
            //'TAG' => ['Розница']
            $params1['FILTER'] = isset($mytag) ? ['TAG' => [$mytag], 'RESPONSIBLE_ID' => $rid, 'REAL_STATUS' => [4, 2, 3]] : ['RESPONSIBLE_ID' => $rid, 'REAL_STATUS' => [4, 2, 3]];
            $params1['PARAMS'] = ['LOAD_TAGS' => 'Y'];
            $result['tasks'][$rid] = (array) $load->getbtasks($method1, $params1)->result;
        }
        //print_r($result);
        json_encode($result, JSON_UNESCAPED_UNICODE);
        file_put_contents('/var/www/html/potasks/potasks.json', json_encode($result, JSON_UNESCAPED_UNICODE));
        break;
    case 'potasks2':
        include 'clss.php';
        $load = new CLoader();
///usr/bin/php /home/u59462/mcrm.pivzavoz24.ru/www/tasks.php?mode=potasks&token=27erabul
        //echo $m_ago = time()-
        $result = [];
        $result['babies'] = $babies;
        foreach ($babies as $rid => $baby) {
            $method1 = 'task.item.list';
            $params1['ORDER'] = ['CREATED_DATE' => 'desc'];
            $params1['FILTER'] = ['RESPONSIBLE_ID' => $rid, 'REAL_STATUS' => [5], '>CLOSED_DATE' => '2019-' . $month . '-01'];
            $params1['PARAMS']['LOAD_TAGS'] = 'Y';
            $params1['PARAMS']['NAV_PARAMS'] = ['nPageSize' => 50, 'iNumPage' => $i];
            $result['tasks'][$rid] = (array) $load->getbtasks($method1, $params1)->result;
        }
        file_put_contents('/var/www/html/potasks2.json', json_encode($result, JSON_UNESCAPED_UNICODE));
        break;
    case 'ramzes':
        include 'clss.php';
        $load = new CLoader();
        $count = 1000;
        $rounds = ceil($count / 50);
        $result = [];
        header('Content-Type: text/html; charset=utf-8');
        echo '<table>';
        for ($i = 0; $i < $rounds; ++$i) {
            $method1 = 'task.item.list';
            $params1['ORDER'] = ['ID' => 'desc'];
            $params1['FILTER'] = (object) ['TAG' => ['Розница'], '>CREATED_DATE' => '2021-01-01'];
            $params1['PARAMS'] = ['LOAD_TAGS' => 'Y'];
            $params1['start'] = $i * 50;
            $resp = (array) $load->getbtasks($method1, $params1);
            foreach ($resp['result'] as $ndx => $task) {
                $task = (array) $task;
                $result[$task['ID']] = $task;
                //echo "<tr><td>".$task['title']."  </td><td>  "."<a target='_blank' href='https://pivzavoz.bitrix24.ru/company/personal/user/1832/tasks/task/view/".$task['id']."/'>".$task['title']."</a>"." </td><td> ".$task['timeEstimate']." </td><td> ".$task['id']." </td><td> ".$task['createdDate']."</td></tr>";
            }
        }
        foreach ($result as $id => $task) {
            // print_r($task);
            echo '<tr><td>' . $task['TITLE'] . '  </td><td>  ' . "<a target='_blank' href='https://pivzavoz.bitrix24.ru/company/personal/user/1832/tasks/task/view/" . $task['ID'] . "/'>" . $task['TITLE'] . '</a>' . ' </td><td> ' . $task['TIME_ESTIMATE'] . ' </td><td> ' . $task['ID'] . ' </td><td> ' . $task['CREATED_DATE'] . '</td></tr>';
        }
        echo '</table>';
        break;
    case 'potasks11':
        include 'clss.php';
        $load = new CLoader();
        $start = microtime(true);
        $method2 = 'task.elapseditem.getlist';
        // $params2['ORDER'] = ["ID" => "DESC"];
        //  $params2['FILTER'] = ['USER_ID' =>array_keys($babies), '>CREATED_DATE' => "2019-" . $month . "-01"];
        $ids = [];
        $count = 2000;
        $rounds = ceil($count / 50);
        for ($i = 0; $i < $rounds; ++$i) {
            $appParams = [
                'ORDER' => ['ID' => 'DESC'], // Сортировка по ID - по убыванию
                'FILTER' => ['USER_ID' => array_keys($babies), '>CREATED_DATE' => '2021-' . $month . '-01'], // Фильтр
                'SELECT' => ['*'], // Выборка - только ID записи и задачи
                'PARAMS' => ['NAV_PARAMS' => [ // Постраничка
                    'nPageSize' => 50, // по 50 элемента на странице
                    'iNumPage' => $i, // страница номер i
                ]],
            ];
            $rz = (array) $load->getbtasks($method2, $appParams);
            foreach ($rz['result'] as $log) {
                $logs[$log->ID] = $log;
                $ids[] = $log->TASK_ID;
            }
        }
        $ids = array_values(array_unique($ids));
        $parts = array_chunk($ids, 50);
        $method1 = 'task.item.list';
        //$method1 = "tasks.task.list";
        foreach ($parts as $ndx => $part) {
            $params1['ORDER'] = ['ID' => 'desc'];
            $params1['FILTER'] = ['ID' => $part];
            $params1['PARAMS'] = ['LOAD_TAGS' => 'Y'];
            $params1['SELECT'] = ['TITLE', 'RESPONSIBLE_ID', 'TAGS', 'CREATED_DATE', 'TIME_SPENT_IN_LOGS', 'ID', 'STATUS','REAL_STATUS'];
            $rz = (array) $load->getbtasks($method1, $params1)->result;
            foreach ($rz as $task) {
                unset($task->ALLOWED_ACTIONS);
                unset($task->CREATED_BY);
               // unset($task->REAL_STATUS);
              //  unset($task->STATUS);
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
                $result2['tasks'][$rid][$tid]['STATUS'] = $result[$tid]->STATUS;
                $result2['tasks'][$rid][$tid]['REAL_STATUS'] = $result[$tid]->REAL_STATUS;
                $result2['tasks'][$rid][$tid]['LOGS'] = $log['LOGS'];
                
                $result2['tasks'][$rid][$tid]['TIME_SPENT_IN_LOGS'] = $log['TIME_SPENT_IN_LOGS'];
            }
        }
        $result2['babies'] = $babies;
        //print_r($result2);
        file_put_contents('/var/www/html/potasks/potasks4.json', json_encode($result2, JSON_UNESCAPED_UNICODE));
        break;
    case 'potasks12':
        if ($datefrom and $dateto) {
            include 'clss.php';
            $load = new CLoader();
            $start = microtime(true);
            $method2 = 'task.elapseditem.getlist';
            // $params2['ORDER'] = ["ID" => "DESC"];
            //  $params2['FILTER'] = ['USER_ID' =>array_keys($babies), '>CREATED_DATE' => "2019-" . $month . "-01"];
            $ids = [];
            $count = 2000;
            $rounds = ceil($count / 50);
            for ($i = 0; $i < $rounds; ++$i) {
                $appParams = [
                    'ORDER' => ['ID' => 'DESC'], // Сортировка по ID - по убыванию
                    'FILTER' => ['USER_ID' => array_keys($babies), '>CREATED_DATE' => $datefrom, '<CREATED_DATE' => $dateto], // Фильтр
                    'SELECT' => ['*'], // Выборка - только ID записи и задачи
                    'PARAMS' => ['NAV_PARAMS' => [ // Постраничка
                        'nPageSize' => 50, // по 50 элемента на странице
                        'iNumPage' => $i, // страница номер i
                    ]],
                ];
                $rz = (array) $load->getbtasks($method2, $appParams);
                foreach ($rz['result'] as $log) {
                    $logs[$log->ID] = $log;
                    $ids[] = $log->TASK_ID;
                }
            }
            $ids = array_values(array_unique($ids));
            $parts = array_chunk($ids, 50);
            $method1 = 'task.item.list';
            //$method1 = "tasks.task.list";
            foreach ($parts as $ndx => $part) {
                $params1['ORDER'] = ['ID' => 'desc'];
                $params1['FILTER'] = isset($mytag) ? (object) ['TAG' => [$mytag], 'ID' => $part] : (object) ['ID' => $part];
                $params1['PARAMS'] = ['LOAD_TAGS' => 'Y'];
                $params1['SELECT'] = ['TITLE', 'RESPONSIBLE_ID', 'TAGS', 'CREATED_DATE', 'TIME_SPENT_IN_LOGS', 'ID','STATUS','REAL_STATUS'];
                $rz = (array) $load->getbtasks($method1, $params1)->result;
                foreach ($rz as $task) {
                  
                    unset($task->ALLOWED_ACTIONS);
                    unset($task->CREATED_BY);
                    unset($task->GROUP_ID);
                    //!$result[$task->RESPONSIBLE_ID] ? $result[$task->RESPONSIBLE_ID] = [] : null;
                    $result[$task->ID] = $task;
                }
            }
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
                    $result2['tasks'][$rid][$tid]['STATUS'] = $result[$tid]->STATUS;
                    $result2['tasks'][$rid][$tid]['REAL_STATUS'] = $result[$tid]->REAL_STATUS;
                    $result2['tasks'][$rid][$tid]['LOGS'] = $log['LOGS'];
                    $result2['tasks'][$rid][$tid]['TIME_SPENT_IN_LOGS'] = $log['TIME_SPENT_IN_LOGS'];
                }
            }
            $result2['babies'] = $babies;
            print_r($result2);
           
            file_put_contents('/var/www/html/potasks/potasks_custom.json', json_encode($result2, JSON_UNESCAPED_UNICODE));
        }
        break;
}
