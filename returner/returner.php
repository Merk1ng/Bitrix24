<?php
/* error_reporting(E_ALL);
ini_set('display_errors', 1); */
header('Content-Type: text/json; charset=utf-8');
$mode = $_GET['mode'] ? $_GET['mode'] : $_SERVER['argv'][1];
$token = $_GET['token'] ? $_GET['token'] : $_SERVER['argv'][2];
$inns = $_GET['inns'];
$refs = [];
$refs[] = $_GET['refdoc'];
$newstatus = $_GET['newstatus'];
// $archive_deps = ['e5ed2738-0a59-11e8-89d6-00155d7c2500',
// '02739e7b-116f-11e8-89d6-00155d7c2500',
// '9565d0db-a1cf-11e7-9cd9-00155d7c2205',
// '9565d0db-a1cf-11e7-9cd9-00155d7c2205',
// '435a6024-9054-11e6-a5e6-f2d21107f511',
// '742bd0f4-ec9d-11e4-ad2e-f2d21107f511',
// 'e0ce20be-dce6-11e3-bc72-fae291787355',
// '9fd08588-bd35-11e6-ac01-f2d21107f511'];
//http://212.49.114.90/retail/returner/returner.php?mode=newstatus&refdoc={=Document:PROPERTY_REF_DOKUMENTA}&newstatus=Completed&token=27erabul
//http://212.49.114.90/retail/returner/returner.php?mode=newstatus&refdoc={=Document:PROPERTY_REF_DOKUMENTA}&newstatus=InWork&token=27erabul
if ($token === "27erabul") {
    switch ($mode) {
        case 'deldocs':
            include 'clss.php';
            $fullresult = [];
            $load = new CLoader();
            $method1 = 'lists.element.get';
            $params1['IBLOCK_TYPE_ID'] = 'bitrix_processes';
            $params1['IBLOCK_ID'] = '234';
            $params1['FILTER'] = ['NAME' => 'ИП Пашков Александр Вячеславович '];
            $count = 1000;
            $rounds = ceil($count / 50);
            for ($i = 0; $i < $rounds; $i++) {
                $params1['start'] = $i * 50;
                $result = (array) $load->getbtasks($method1, $params1);
                $fullresult = array_merge($fullresult, $result['result']);
            }
            foreach ($fullresult as $proccess) {
                // print_r($proccess->ID);
                $method23 = 'lists.element.delete';
                $params23['IBLOCK_TYPE_ID'] = 'bitrix_processes';
                $params23['IBLOCK_ID'] = '234';
                $params23['ELEMENT_ID'] = $proccess->ID;
                $result = (array) $load->getbtasks($method23, $params23);
                print_r($result);
            }
            break;
        case 'getdocs':
            include 'clss.php';
            $load = new CLoader();
            $d = $load->connect2('https://1c.pivzavoz.ru/franch-rozn/odata/standard.odata/Document_%D0%BF%D0%B8%D0%B2%D0%90%D0%BA%D1%82%D0%92%D0%BE%D0%B7%D0%B2%D1%80%D0%B0%D1%82%D0%B0?$format=json;odata=nometadata&$filter=DeletionMark%20eq%20false%20and%20%D0%A1%D1%82%D0%B0%D1%82%D1%83%D1%81%20eq%20%27%D0%9D%D0%BE%D0%B2%D1%8B%D0%B9%27');
            $m = $load->connect2('https://1c.pivzavoz.ru/franch-rozn/odata/standard.odata/Catalog_%D0%9C%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%D1%8B?$format=json;odata=nometadata');
            $shops = [];
            $docs = [];
//Находим ранее загруженный документы из Битрикса
            $hashes = [];
            $result1 = $load->getbtasks("lists.element.get", ['IBLOCK_TYPE_ID' => 'bitrix_processes', 'IBLOCK_ID' => 234]);
            foreach ($result1->result as $ndx => $elem) {
                $elem->PROPERTY_3124 ? $hashes[] = array_values((array) $elem->PROPERTY_3124)[0] : '';
            }
            foreach ($m->value as $ndx => $shop) {
                print_r($shop);
                !$shops[$shop->Ref_Key] ? $shops[$shop->Ref_Key] = $shop->КонтактнаяИнформация[0]->Представление : '';
            }
            print_r($shops);
            foreach ($d->value as $ndx => $doc) {
                $goods = '';
                if (!array_key_exists($doc->Ref_Key, $docs)) {
                    $docs[$doc->Ref_Key] = (array) $doc;
                    $docs[$doc->Ref_Key]['shop_adress'] = $shops[$doc->Магазин_Key];
                    $g = $doc->Товар;
                    $quas = [];
                    $reasons = [];
                    $suppliers = [];
                    $date_m = [];
                    $time_connceted = [];
                    $onlyitems = [];
                    $tikets = [];
                    $shelflife = [];
                    $r_number = [];
                    $r_date = [];
                    foreach ($g as $good) {
                        $supplier = $load->connect2('https://1c.pivzavoz.ru/franch-rozn/odata/standard.odata/Catalog_%D0%9A%D0%BE%D0%BD%D1%82%D1%80%D0%B0%D0%B3%D0%B5%D0%BD%D1%82%D1%8B?$format=json;odata=nometadata&$filter=IsFolder%20eq%20false%20and%20Ref_Key%20eq%20guid%27' . $good->Поставщик_Key . '%27');
                        $item = $load->connect2('https://1c.pivzavoz.ru/franch-rozn/odata/standard.odata/Catalog_%D0%9D%D0%BE%D0%BC%D0%B5%D0%BD%D0%BA%D0%BB%D0%B0%D1%82%D1%83%D1%80%D0%B0?$format=json;odata=nometadata&$filter=Ref_Key%20eq%20guid%27' . $good->Товар_Key . '%27');
                        $r_docs = $load->connect2('https://1c.pivzavoz.ru/franch-rozn/odata/standard.odata/Document_%D0%9F%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%BB%D0%B5%D0%BD%D0%B8%D0%B5%D0%A2%D0%BE%D0%B2%D0%B0%D1%80%D0%BE%D0%B2/?$format=json;odata=nometadata&$filter=Ref_Key%20eq%20guid%27' . $good->ДокументПоступления_Key . '%27&$select=%D0%9D%D0%BE%D0%BC%D0%B5%D1%80%D0%92%D1%85%D0%BE%D0%B4%D1%8F%D1%89%D0%B5%D0%B3%D0%BE%D0%94%D0%BE%D0%BA%D1%83%D0%BC%D0%B5%D0%BD%D1%82%D0%B0,%D0%94%D0%B0%D1%82%D0%B0%D0%92%D1%85%D0%BE%D0%B4%D1%8F%D1%89%D0%B5%D0%B3%D0%BE%D0%94%D0%BE%D0%BA%D1%83%D0%BC%D0%B5%D0%BD%D1%82%D0%B0');
                        $r_docs = $r_docs->value[0];
                        //$docs[$doc->Ref_Key]['supplier']=$supplier->value[0]->Description;
                        $goods .= $item->value[0]->Description . "\n";
                        $goods .= "Количество: " . $good->Количество . "\n";
                        $goods .= "Вес: " . $good->Вес . "\n";
                        $goods .= $good->ЦелостностьЭтикетки ? "Целостность Этикетки: Да \n" : "Целостность Этикетки: Нет \n";
                        $good->ДатаПроизводстваРозлива ? $goods .= "Дата Производства Розлива: " . explode("T", $good->ДатаПроизводстваРозлива)[0] . "\n" : '';
                        $goods .= "Поставщик: " . str_replace('"', '', $supplier->value[0]->Description) . "\n";
                        $goods .= "Срок Годности (сут.): " . $good->СрокГодностиСутки . "\n\n";
                        $goods .= "Причина Возврата:" . $good->ПричинаВозврата . "\n\n";
                        $goods .= "Номер документа поступления:" . $r_docs->НомерВходящегоДокумента . "\n\n";
                        $goods .= "Дата документа поступления:" . explode("T", $r_docs->ДатаВходящегоДокумента)[0] . "\n\n";
                        $good->ВремяПодключенногоСостоянияКегиДни ? $goods .= "Время Подключенного Состояния Кеги (Дни): " . $good->ВремяПодключенногоСостоянияКегиДни . "\n" : '';
                        $good->ВремяПодключенногоСостоянияКегиЧасы ? $goods .= "Время Подключенного Состояния Кеги (Часы): " . $good->ВремяПодключенногоСостоянияКегиЧасы . "\n" : '';
                        $good->ДатаПодключенияКеги ? $goods .= "Дата Подключения Кеги: " . explode("T", $good->ДатаПодключенияКеги)[0] . "\n" : '';
                        $goods .= "------------------------------\n\n";
                        $shelflife[] = $good->СрокГодностиСутки;
                        $tikets[] = $good->ЦелостностьЭтикетки;
                        $onlyitems[] = $item->value[0]->Description;
                        $reasons[] = $good->ПричинаВозврата;
                        $quas[] = $good->Количество;
                        $weights[] = $good->Вес;
                        $date_m[] = $good->СрокГодностиСутки;
                        $time_connceted[] = $good->ВремяПодключенногоСостоянияКегиДни . "-" . $good->ВремяПодключенногоСостоянияКегиЧасы;
                        $suppliers[] = str_replace('"', '', $supplier->value[0]->Description);
                        $r_number[] = $r_docs->НомерВходящегоДокумента;
                        $r_date[] = explode("T", $r_docs->ДатаВходящегоДокумента)[0];
                    }
                    $owner = $load->connect2('https://1c.pivzavoz.ru/franch-rozn/odata/standard.odata/Catalog_%D0%9E%D1%80%D0%B3%D0%B0%D0%BD%D0%B8%D0%B7%D0%B0%D1%86%D0%B8%D0%B8?$format=json;odata=nometadata&$filter=Ref_Key%20eq%20guid%27' . $doc->Покупатель_Key . '%27');
                    unset($docs[$doc->Ref_Key]['Товар']);
                    $docs[$doc->Ref_Key]['Date'] = explode("T", $doc->Date)[0];
                    $docs[$doc->Ref_Key]['DateBack'] = explode("T", $doc->Date)[0];
                    $docs[$doc->Ref_Key]['owner'] = $owner->value[0]->Description ? $owner->value[0]->Description : $owner->value[0]->ИНН;
                    $docs[$doc->Ref_Key]['goods'] = $goods;
                    $docs[$doc->Ref_Key]['shelflife'] = implode("|", $shelflife);
                    $docs[$doc->Ref_Key]['tikets'] = implode("|", $tikets);
                    $docs[$doc->Ref_Key]['onlyitems'] = implode("|", $onlyitems);
                    $docs[$doc->Ref_Key]['reasons'] = implode("|", $reasons);
                    $docs[$doc->Ref_Key]['quas'] = implode("|", $quas);
                    $docs[$doc->Ref_Key]['weights'] = implode("|", $weights);
                    $docs[$doc->Ref_Key]['date_m'] = implode("|", $date_m);
                    $docs[$doc->Ref_Key]['time_connceted'] = implode("|", $time_connceted);
                    $docs[$doc->Ref_Key]['suppliers'] = implode("|", $suppliers);
                    $docs[$doc->Ref_Key]['r_number'] = implode("|", $r_number);
                    $docs[$doc->Ref_Key]['r_date'] = implode("|", $r_date);
                    unset($docs[$doc->Ref_Key]['ДатаВозврата']);
                }
            }
            foreach ($docs as $ref => $doc) {
                $params = [];
                $datedoc = explode("-", $doc['Date']);
                $dateBack = explode("-", $doc['Date']);
                $params['datedoc'] = $datedoc[2] . '.' . $datedoc[1] . '.' . $datedoc[0];
                $params['dateback'] = $dateBack[2] . '.' . $dateBack[1] . '.' . $dateBack[0];
                $params['frombuyer'] = $doc['owner'];
                $params['adress'] = $doc['shop_adress'];
                $params['file_catalog'] = $doc['goods'];
                $params['goods'] = $doc['goods'];
                $params['status'] = $doc['Статус'];
                $params['refshop'] = $doc['Магазин_Key'];
                $params['Ref_Key'] = $ref;
                $params['liquid'] = $doc['Разливной'];
                $params['shelflife'] = $doc['shelflife'];
                $params['tikets'] = $doc['tikets'];
                $params['onlyitems'] = $doc['onlyitems'];
                $params['reasons'] = $doc['reasons'];
                $params['quas'] = $doc['quas'];
                $params['weights'] = $doc['weights'];
                $params['date_m'] = $doc['date_m'];
                $params['time_connceted'] = $doc['time_connceted'];
                $params['suppliers'] = $doc['suppliers'];
                $params['r_number'] = $doc['r_number'];
                $params['r_date'] = $doc['r_date'];
                $toupdatefileds = [
                    'PROPERTY_3354' => $doc['shelflife'],
                    'PROPERTY_3342' => $doc['tikets'],
                    'PROPERTY_3344' => $doc['onlyitems'],
                    'PROPERTY_3346' => $doc['reasons'],
                    'PROPERTY_3356' => $doc['quas'],
                    'PROPERTY_3358' => $doc['weights'],
                    'PROPERTY_3350' => $doc['date_m'],
                    'PROPERTY_3352' => $doc['time_connceted'],
                    'PROPERTY_3348' => $doc['suppliers'],
                    'PROPERTY_3340' => $doc['r_number'],
                    'PROPERTY_3338' => $doc['r_date'],
                ];
                $toupdateparams = [
                    'IBLOCK_TYPE_ID' => 'bitrix_processes',
                    'IBLOCK_ID' => 234,
                    'FIELDS' => $toupdatefileds,
                ];
                //    $result17 = $load->getbtasks("lists.element.update", $toupdateparams);
                !in_array($ref, $hashes) ? $result1 = $load->getbtasks2("bizproc.workflow.start", ['PARAMETERS' => $params, 'DOCUMENT_ID' => ['bizproc', 'CIBlockDocument', 467128], 'TEMPLATE_ID' => 406]) : '';
            }
            break;
        case 'updatedocs':
            include 'clss.php';
            $load = new CLoader();
            $d = $load->connect2('https://1c.pivzavoz.ru/franch-rozn/odata/standard.odata/Document_%D0%BF%D0%B8%D0%B2%D0%90%D0%BA%D1%82%D0%92%D0%BE%D0%B7%D0%B2%D1%80%D0%B0%D1%82%D0%B0?$format=json;odata=nometadata&$filter=DeletionMark%20eq%20false');
            $m = $load->connect2('https://1c.pivzavoz.ru/franch-rozn/odata/standard.odata/Catalog_%D0%9C%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%D1%8B?$format=json;odata=nometadata');
            $shops = [];
            $docs = [];
            //Находим ранее загруженный документы из Битрикса
            $hashes = [];
            $result1 = $load->getbtasks("lists.element.get", ['IBLOCK_TYPE_ID' => 'bitrix_processes', 'IBLOCK_ID' => 234]);
            foreach ($result1->result as $ndx => $elem) {
                //elem->PROPERTY_3124 ? $hashes[$elem->ID]['refkey'] = array_values((array) $elem->PROPERTY_3124)[0] : '';
                $elem->PROPERTY_3124 ? $hashes[$elem->ID] = (array) $elem : '';
            }
            foreach ($m->value as $ndx => $shop) {
                !$shops[$shop->Ref_Key] ? $shops[$shop->Ref_Key] = $shop->КонтактнаяИнформация[0]->Представление : '';
            }
            unset($hashes[137110]);
            unset($hashes[137068]);
            foreach ($d->value as $ndx => $doc) {
                $goods = '';
                if (!array_key_exists($doc->Ref_Key, $docs)) {
                    $docs[$doc->Ref_Key] = (array) $doc;
                    $docs[$doc->Ref_Key]['shop_adress'] = $shops[$doc->Магазин_Key];
                    $g = $doc->Товар;
                    $quas = [];
                    $reasons = [];
                    $suppliers = [];
                    $date_m = [];
                    $time_connceted = [];
                    $onlyitems = [];
                    $weights = [];
                    $tikets = [];
                    $shelflife = [];
                    $r_number = [];
                    $r_date = [];
                    foreach ($g as $good) {
                        $supplier = $load->connect2('https://1c.pivzavoz.ru/franch-rozn/odata/standard.odata/Catalog_%D0%9A%D0%BE%D0%BD%D1%82%D1%80%D0%B0%D0%B3%D0%B5%D0%BD%D1%82%D1%8B?$format=json;odata=nometadata&$filter=IsFolder%20eq%20false%20and%20Ref_Key%20eq%20guid%27' . $good->Поставщик_Key . '%27');
                        $item = $load->connect2('https://1c.pivzavoz.ru/franch-rozn/odata/standard.odata/Catalog_%D0%9D%D0%BE%D0%BC%D0%B5%D0%BD%D0%BA%D0%BB%D0%B0%D1%82%D1%83%D1%80%D0%B0?$format=json;odata=nometadata&$filter=Ref_Key%20eq%20guid%27' . $good->Товар_Key . '%27');
                        $r_docs = $load->connect2('https://1c.pivzavoz.ru/franch-rozn/odata/standard.odata/Document_%D0%9F%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%BB%D0%B5%D0%BD%D0%B8%D0%B5%D0%A2%D0%BE%D0%B2%D0%B0%D1%80%D0%BE%D0%B2/?$format=json;odata=nometadata&$filter=Ref_Key%20eq%20guid%27' . $good->ДокументПоступления_Key . '%27&$select=%D0%9D%D0%BE%D0%BC%D0%B5%D1%80%D0%92%D1%85%D0%BE%D0%B4%D1%8F%D1%89%D0%B5%D0%B3%D0%BE%D0%94%D0%BE%D0%BA%D1%83%D0%BC%D0%B5%D0%BD%D1%82%D0%B0,%D0%94%D0%B0%D1%82%D0%B0%D0%92%D1%85%D0%BE%D0%B4%D1%8F%D1%89%D0%B5%D0%B3%D0%BE%D0%94%D0%BE%D0%BA%D1%83%D0%BC%D0%B5%D0%BD%D1%82%D0%B0');
                        $r_docs = $r_docs->value[0];
                        //$docs[$doc->Ref_Key]['supplier']=$supplier->value[0]->Description;
                        $goods .= $item->value[0]->Description . "\n";
                        $goods .= "Количество: " . $good->Количество . "\n";
                        $goods .= "Вес: " . $good->Вес . "\n";
                        $goods .= $good->ЦелостностьЭтикетки ? "Целостность Этикетки: Да \n" : "Целостность Этикетки: Нет \n";
                        $good->ДатаПроизводстваРозлива ? $goods .= "Дата Производства Розлива: " . explode("T", $good->ДатаПроизводстваРозлива)[0] . "\n" : '';
                        $goods .= "Поставщик: " . str_replace('"', '', $supplier->value[0]->Description) . "\n";
                        $goods .= "Срок Годности (сут.): " . $good->СрокГодностиСутки . "\n\n";
                        $goods .= "Причина Возврата:" . $good->ПричинаВозврата . "\n\n";
                        $goods .= "Номер документа поступления:" . $r_docs->НомерВходящегоДокумента . "\n\n";
                        $goods .= "Дата документа поступления:" . explode("T", $r_docs->ДатаВходящегоДокумента)[0] . "\n\n";
                        $good->ВремяПодключенногоСостоянияКегиДни ? $goods .= "Время Подключенного Состояния Кеги (Дни): " . $good->ВремяПодключенногоСостоянияКегиДни . "\n" : '';
                        $good->ВремяПодключенногоСостоянияКегиЧасы ? $goods .= "Время Подключенного Состояния Кеги (Часы): " . $good->ВремяПодключенногоСостоянияКегиЧасы . "\n" : '';
                        $good->ДатаПодключенияКеги ? $goods .= "Дата Подключения Кеги: " . explode("T", $good->ДатаПодключенияКеги)[0] . "\n" : '';
                        $goods .= "------------------------------\n\n";
                        $shelflife[] = $good->СрокГодностиСутки;
                        $tikets[] = $good->ЦелостностьЭтикетки;
                        $onlyitems[] = $item->value[0]->Description;
                        $reasons[] = $good->ПричинаВозврата;
                        $quas[] = $good->Количество;
                        $weights[] = $good->Вес;
                        $date_m[] = $good->СрокГодностиСутки;
                        $time_connceted[] = $good->ВремяПодключенногоСостоянияКегиДни . "-" . $good->ВремяПодключенногоСостоянияКегиЧасы;
                        $suppliers[] = str_replace('"', '', $supplier->value[0]->Description);
                        $r_number[] = $r_docs->НомерВходящегоДокумента;
                        $r_date[] = explode("T", $r_docs->ДатаВходящегоДокумента)[0];
                    }
                    $owner = $load->connect2('https://1c.pivzavoz.ru/franch-rozn/odata/standard.odata/Catalog_%D0%9E%D1%80%D0%B3%D0%B0%D0%BD%D0%B8%D0%B7%D0%B0%D1%86%D0%B8%D0%B8?$format=json;odata=nometadata&$filter=Ref_Key%20eq%20guid%27' . $doc->Покупатель_Key . '%27');
                    unset($docs[$doc->Ref_Key]['Товар']);
                    $docs[$doc->Ref_Key]['Date'] = explode("T", $doc->Date)[0];
                    $docs[$doc->Ref_Key]['DateBack'] = explode("T", $doc->Date)[0];
                    $docs[$doc->Ref_Key]['owner'] = $owner->value[0]->Description ? $owner->value[0]->Description : $owner->value[0]->ИНН;
                    $docs[$doc->Ref_Key]['goods'] = $goods;
                    $docs[$doc->Ref_Key]['shelflife'] = implode("|", $shelflife);
                    $docs[$doc->Ref_Key]['tikets'] = implode("|", $tikets);
                    $docs[$doc->Ref_Key]['onlyitems'] = implode("|", $onlyitems);
                    $docs[$doc->Ref_Key]['reasons'] = implode("|", $reasons);
                    $docs[$doc->Ref_Key]['quas'] = implode("|", $quas);
                    $docs[$doc->Ref_Key]['weights'] = implode("|", $weights);
                    $docs[$doc->Ref_Key]['date_m'] = implode("|", $date_m);
                    $docs[$doc->Ref_Key]['time_connceted'] = implode("|", $time_connceted);
                    $docs[$doc->Ref_Key]['suppliers'] = implode("|", $suppliers);
                    $docs[$doc->Ref_Key]['r_number'] = implode("|", $r_number);
                    $docs[$doc->Ref_Key]['r_date'] = implode("|", $r_date);
                    unset($docs[$doc->Ref_Key]['ДатаВозврата']);
                }
            }
            foreach ($docs as $ref => $doc) {
                $params = [];
                $datedoc = explode("-", $doc['Date']);
                $dateBack = explode("-", $doc['Date']);
                $params['datedoc'] = $datedoc[2] . '.' . $datedoc[1] . '.' . $datedoc[0];
                $params['dateback'] = $dateBack[2] . '.' . $dateBack[1] . '.' . $dateBack[0];
                $params['frombuyer'] = $doc['owner'];
                $params['adress'] = $doc['shop_adress'];
                $params['file_catalog'] = $doc['goods'];
                $params['goods'] = $doc['goods'];
                $params['status'] = $doc['Статус'];
                $params['refshop'] = $doc['Магазин_Key'];
                $params['Ref_Key'] = $ref;
                $params['liquid'] = $doc['Разливной'];
                $params['shelflife'] = $doc['shelflife'];
                $params['tikets'] = $doc['tikets'];
                $params['onlyitems'] = $doc['onlyitems'];
                $params['reasons'] = $doc['reasons'];
                $params['quas'] = $doc['quas'];
                $params['weights'] = $doc['weights'];
                $params['date_m'] = $doc['date_m'];
                $params['time_connceted'] = $doc['time_connceted'];
                $params['suppliers'] = $doc['suppliers'];
                $params['r_number'] = $doc['r_number'];
                $params['r_date'] = $doc['r_date'];
            }
            foreach ($hashes as $iid => $elem) {
                $doc = $docs[array_values($elem['PROPERTY_3124'][0])];
                $datedoc = explode("-", $doc['Date']);
                $toupdatefileds = [
                    'NAME' => $doc['owner'],
                    'PROPERTY_3138' => $datedoc[2] . '.' . $datedoc[1] . '.' . $datedoc[0],
                    'PROPERTY_3108' => $datedoc[2] . '.' . $datedoc[1] . '.' . $datedoc[0],
                    'PROPERTY_3110' => $doc['owner'],
                    'PROPERTY_3112' => $doc['shop_adress'],
                    'PROPERTY_3114' => $doc['goods'],
                    'PROPERTY_3116' => $doc['file_catalog'],
                    'PROPERTY_3120' => $doc['Статус'],
                    'PROPERTY_3122' => $doc['Разливной'],
                    'PROPERTY_3124' => $doc['Ref_Key'],
                    'PROPERTY_3126' => $doc['Магазин_Key'],
                    'PROPERTY_3354' => $doc['shelflife'],
                    'PROPERTY_3342' => $doc['tikets'],
                    'PROPERTY_3344' => $doc['onlyitems'],
                    'PROPERTY_3346' => $doc['reasons'],
                    'PROPERTY_3356' => $doc['quas'],
                    'PROPERTY_3358' => $doc['weights'],
                    'PROPERTY_3350' => $doc['date_m'],
                    'PROPERTY_3352' => $doc['time_connceted'],
                    'PROPERTY_3348' => $doc['suppliers'],
                    'PROPERTY_3340' => $doc['r_number'],
                    'PROPERTY_3338' => $doc['r_date'],
                ];
                $toupdateparams = [
                    'IBLOCK_TYPE_ID' => 'bitrix_processes',
                    'IBLOCK_ID' => 234,
                    'ELEMENT_ID' => $iid,
                    'FIELDS' => $toupdatefileds,
                ];
                //$result17 = $load->getbtasks("lists.element.update", $toupdateparams);
                // !in_array($ref, $hashes) ? $result1 = $load->getbtasks2("bizproc.workflow.start", ['PARAMETERS' => $params, 'DOCUMENT_ID' => ['bizproc', 'CIBlockDocument', 125498], 'TEMPLATE_ID' => 406]) : '';
                //echo count ($result1);
            }
            break;
        case 'newstatus':
            if ($newstatus and count($refs) > 0) {
                $params = ['Status' => $newstatus, 'Act_ref' => $refs];
                //echo (json_encode($params));
                $curl = curl_init();
                $url = "https://1c.pivzavoz.ru/franch-rozn/hs/Franch_HTTP/V1/ReturnActStatus";
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params, JSON_UNESCAPED_UNICODE));
                curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($curl, CURLOPT_USERPWD, "Администратор:RfptvbhVftdbx007");
                $result = curl_exec($curl);
                curl_close($curl);
            }
            break;
        case 'costitem':
            include 'clss.php';
            $load = new CLoader();
            $method1 = 'lists.element.get';
            $params1['IBLOCK_TYPE_ID'] = 'bitrix_processes';
            $params1['IBLOCK_ID'] = '258';
            $params1['ELEMENT_ORDER'] = ['ID' => 'DESC'];
            $count = 2500;
            $rounds = ceil($count / 50);
            $fullresult = [];
            $myitems = [];
            $archive_items = [];
            $archive_items = findfolders("5ac86679-0fdb-11e9-9d37-00155d7c2205");
//            print_r($archive_items);
            if (count($archive_items) > 0) {
                for ($i = 0; $i < $rounds; $i++) {
                    $params1['start'] = $i * 50;
                    $result = (array) $load->getbtasks($method1, $params1);
                    $fullresult = array_merge($fullresult, $result['result']);
                }
                foreach ($fullresult as $ndx => $proccess) {
                    $ref = array_values((array) $proccess->PROPERTY_3318)[0];
                    $myitems[] = $ref;
                }
                $myitems = array_unique($myitems);
                //print_r($myitems);
                $ci = $load->connect_torg('https://1c.pivzavoz.ru/pivzavoz_new/odata/standard.odata/Catalog_%D0%A1%D1%82%D0%B0%D1%82%D1%8C%D0%B8%D0%97%D0%B0%D1%82%D1%80%D0%B0%D1%82?$format=json;odata=nometadata&$filter=IsFolder%20eq%20false%20and%20DeletionMark%20eq%20false');
                foreach ($ci->value as $ndx => $item) {
                    $params = [];
                    $params['typecost'] = $item->ХарактерЗатрат;
                    $params['type'] = $item->ВидЗатрат;
                    $params['desc'] = $item->Description;
                    $params['Ref_Key'] = $item->Ref_Key;
                    $params['code'] = $item->Code;
                    $result1 = !in_array($item->Ref_Key, $myitems) && !in_array($item->Parent_Key, $archive_items) ? $load->getbtasks2("bizproc.workflow.start", ['PARAMETERS' => $params, 'DOCUMENT_ID' => ['bizproc', 'CIBlockDocument', 158390], 'TEMPLATE_ID' => 552]) : '';
                    //!in_array($item->Ref_Key, $myitems) ? $item->Ref_Key : '';
                    print_r($result1);
                }
            }
            break;
        case 'deps2':
            include 'clss.php';
            $load = new CLoader();
            $method1 = 'lists.element.get';
            $params1['IBLOCK_TYPE_ID'] = 'bitrix_processes';
            $params1['IBLOCK_ID'] = '260';
            // $params1['ELEMENT_ORDER'] = ['ID' => 'DESC'];
            $params1['FILTER'] = [">=ID" => 133348];
            $count = 600;
            $rounds = ceil($count / 50);
            $fullresult = [];
            $myitems = [];
            $archive_deps = [];
            $archive_deps = findfolders_deps("e5ed2738-0a59-11e8-89d6-00155d7c2500");
            for ($i = 0; $i < $rounds; $i++) {
                $params1['start'] = $i * 50;
                $result = (array) $load->getbtasks($method1, $params1);
                $fullresult = array_merge($fullresult, $result['result']);
            }
            echo count($fullresult) . "\n\n";
            foreach ($fullresult as $ndx => $proccess) {
                $name = $proccess->NAME;
                $ref = array_values((array) $proccess->PROPERTY_3322)[0];
                $ref ? $myitems[$ref] = ["name" => $name, "ID" => $proccess->ID] : '';
            }
            if (count($myitems) > 10) {
                $to_add = [];
                $to_update = [];
                $to_del = [];
                //echo count($myitems);
                $dp = $load->connect_torg('https://1c.pivzavoz.ru/pivzavoz_new/odata/standard.odata/Catalog_%D0%9F%D0%BE%D0%B4%D1%80%D0%B0%D0%B7%D0%B4%D0%B5%D0%BB%D0%B5%D0%BD%D0%B8%D1%8F?$format=json;odata=nometadata&$filter=DeletionMark%20eq%20false%20and%20пивАрхивное%20eq%20false', true);
                $result1 = [];
                foreach ($dp->value as $ndx => $item) {
                    $params = [];
                    if (!stristr($item->Description, '<<') and !stristr($item->Description, '>>')) {
                        $params['desc'] = $item->Description;
                        $params['Ref_Key'] = $item->Ref_Key;
                        $params['code'] = $item->Code;
                        if (!array_key_exists($item->Ref_Key, $myitems)) {
                            $to_add[] = $item;
                        }
                        if ($item->Description != $myitems[$item->Ref_Key]["name"]) {
                            $to_update[] = $item;
                        }
                        if ($myitems[$item->Ref_Key] && in_array($item->Parent_Key, $archive_deps)) {
                            $to_del[] = $item;
                        }
                        //$params['Parent_Key'] = $item->Parent_Key;
                        // !$myitems[$item->Ref_Key] ? $result1[] = [$item->Ref_Key, $item->Description] : "";
                        // $load->getbtasks2("bizproc.workflow.start", ['PARAMETERS' => $params, 'DOCUMENT_ID' => ['bizproc', 'CIBlockDocument', 133348], 'TEMPLATE_ID' => 554]);
                        /*   $result2 = $myitems[$item->Ref_Key]&&$myitems[$item->Ref_Key]!=$item->Description  || !$myitems[$item->Ref_Key] ? $load->getbtasks2("bizproc.workflow.start", ['PARAMETERS' => $params, 'DOCUMENT_ID' => ['bizproc', 'CIBlockDocument', 133348], 'TEMPLATE_ID' => 554]) : ''; */
                    }
                }
                if (count($to_del)) {
                    echo "На удаление:";
                    print_r($to_del);
                }
                if (count($to_add)) {
                    echo "На добавление:";
                    foreach ($to_add as $tu) {
                        $params = [];
                        $fields = [];
                        $fields["NAME"] = $tu->Description;
                        $fields["PROPERTY_3322"] = $tu->Ref_Key;
                        $fields["PROPERTY_3324"] = $tu->Code;
                        $params['IBLOCK_TYPE_ID'] = 'bitrix_processes';
                        $params['IBLOCK_ID'] = '260';
                        $params['ELEMENT_CODE'] = $tu->Code;
                        $params['FIELDS'] = $fields;
                        print_r($load->getbtasks2("lists.element.add", $params));
                    }
                }
                if (count($to_update)) {
                    echo "На обновление:";
                    foreach ($to_update as $tu) {
                        $params = [];
                        $fields = [];
                        $fields["NAME"] = $tu->Description;
                        $fields["PROPERTY_3322"] = $tu->Ref_Key;
                        $fields["PROPERTY_3324"] = $tu->Code;
                        $params['IBLOCK_TYPE_ID'] = 'bitrix_processes';
                        $params['IBLOCK_ID'] = '260';
                        $params['ELEMENT_ID'] = $myitems[$tu->Ref_Key]["ID"];
                        $params['FIELDS'] = $fields;
                        print_r($load->getbtasks2("lists.element.update", $params));
                    }
                }
            }
            break;
        case 'deps':
            include 'clss.php';
            $load = new CLoader();
            $method1 = 'lists.element.get';
            $params1['IBLOCK_TYPE_ID'] = 'bitrix_processes';
            $params1['IBLOCK_ID'] = '260';
            $params1['ELEMENT_ORDER'] = ['ID' => 'DESC'];
            $count = 1500;
            $rounds = ceil($count / 50);
            $fullresult = [];
            $myitems = [];
            $archive_deps = [];
            $archive_deps = findfolders_deps("e5ed2738-0a59-11e8-89d6-00155d7c2500");
            for ($i = 0; $i < $rounds; $i++) {
                $params1['start'] = $i * 50;
                $result = (array) $load->getbtasks($method1, $params1);
                $fullresult = array_merge($fullresult, $result['result']);
            }
            foreach ($fullresult as $ndx => $proccess) {
                $ref = array_values((array) $proccess->PROPERTY_3322)[0];
                $ref ? $myitems[$ref] = $ref : '';
            }
            //$myitems = array_unique($myitems);
            $dp = $load->connect_torg('https://1c.pivzavoz.ru/pivzavoz_new/odata/standard.odata/Catalog_%D0%9F%D0%BE%D0%B4%D1%80%D0%B0%D0%B7%D0%B4%D0%B5%D0%BB%D0%B5%D0%BD%D0%B8%D1%8F?$format=json;odata=nometadata&$filter=DeletionMark%20eq%20false%20and%20пивАрхивное%20eq%20false');
            $result1 = [];
            foreach ($dp->value as $ndx => $item) {
                $params = [];
                $params['desc'] = $item->Description;
                $params['Ref_Key'] = $item->Ref_Key;
                $params['code'] = $item->Code;
                //$params['Parent_Key'] = $item->Parent_Key;
                !$myitems[$item->Ref_Key] && !in_array($item->Parent_Key, $archive_deps) ? $result1[] = [$item->Ref_Key, $item->Description] : "";
                // $load->getbtasks2("bizproc.workflow.start", ['PARAMETERS' => $params, 'DOCUMENT_ID' => ['bizproc', 'CIBlockDocument', 133348], 'TEMPLATE_ID' => 554]);
                $result2 = !$myitems[$item->Ref_Key] && !in_array($item->Parent_Key, $archive_deps) ? $load->getbtasks2("bizproc.workflow.start", ['PARAMETERS' => $params, 'DOCUMENT_ID' => ['bizproc', 'CIBlockDocument', 133348], 'TEMPLATE_ID' => 554]) : '';
            }
            // print_r($myitems);
            // print_r($result1);
            break;
        case 'payers':
            include 'clss.php';
            $load = new CLoader();
            $method1 = 'lists.element.get';
            $params1['IBLOCK_TYPE_ID'] = 'bitrix_processes';
            $params1['IBLOCK_ID'] = '192';
            $params1['ELEMENT_ORDER'] = ['ID' => 'DESC'];
            $count = 2500;
            $rounds = ceil($count / 50);
            $fullresult = [];
            $myitems = [];
            $archive_deps = [];
            //$archive_deps=findfolders_deps("e5ed2738-0a59-11e8-89d6-00155d7c2500");
            for ($i = 0; $i < $rounds; $i++) {
                $params1['start'] = $i * 50;
                $result = (array) $load->getbtasks($method1, $params1);
                $fullresult = array_merge($fullresult, $result['result']);
            }
            foreach ($fullresult as $ndx => $proccess) {
                $inn = array_values((array) $proccess->PROPERTY_1984)[0];
                $ref = array_values((array) $proccess->PROPERTY_3488)[0];
                $code = array_values((array) $proccess->PROPERTY_3490)[0];
                $inn ? $myitems[$inn]['lid'] = $proccess->ID : '';
                $inn ? $myitems[$inn]['inn'] = $inn : '';
                $ref ? $myitems[$inn]['ref'] = $ref : '';
                $code ? $myitems[$inn]['code'] = $code : '';
                $inn ? $myitems[$inn]['name'] = $proccess->NAME : '';
                print_r($myitems);
            }
            $dp = $load->connect_torg('https://1c.pivzavoz.ru/pivzavoz_new/odata/standard.odata/Catalog_%D0%9E%D1%80%D0%B3%D0%B0%D0%BD%D0%B8%D0%B7%D0%B0%D1%86%D0%B8%D0%B8?$format=json;odata=nometadata&$filter=DeletionMark%20eq%20false');
            $dp2 = $load->connect_upp('https://1c.pivzavoz.ru/upp_limon/odata/standard.odata/Catalog_%D0%9E%D1%80%D0%B3%D0%B0%D0%BD%D0%B8%D0%B7%D0%B0%D1%86%D0%B8%D0%B8?$format=json;odata=nometadata&$filter=DeletionMark%20eq%20false');
            foreach ($dp->value as $ndx => $item) {
                if (!$myitems[$item->ИНН] and $item->ИНН and $item->Code != '000000178') {
                    $method2 = 'lists.element.add';
                    $params2['IBLOCK_TYPE_ID'] = 'bitrix_processes';
                    $params2['IBLOCK_ID'] = '192';
                    $params2['ELEMENT_CODE'] = $item->Code;
                    $params2['FIELDS']['PROPERTY_1984'] = (object) ['n0' => $item->ИНН];
                    $params2['FIELDS']['PROPERTY_3490'] = (object) ['n0' => $item->Code];
                    $params2['FIELDS']['PROPERTY_3488'] = (object) ['n0' => $item->Ref_Key];
                    $params2['FIELDS']['NAME'] = $item->Description . " (" . $item->ИНН . ")";
                    $result = (array) $load->getbtasks($method2, $params2);
                    //print_r($result);
                }
                // $params['desc'] = $item->Description;
                // $params['Ref_Key'] = $item->Ref_Key;
                // $params['code'] = $item->Code;
                // $params['Parent_Key'] = $item->Parent_Key;
                // !$myitems[$item->Ref_Key]&& !in_array($item->Parent_Key, $archive_deps) ? $result1[] = [$item->Ref_Key, $item->Description] : "";
                // $load->getbtasks2("bizproc.workflow.start", ['PARAMETERS' => $params, 'DOCUMENT_ID' => ['bizproc', 'CIBlockDocument', 133348], 'TEMPLATE_ID' => 554]);
                // $result2 = !$myitems[$item->Ref_Key] && !in_array($item->Parent_Key, $archive_deps) ? $load->getbtasks2("bizproc.workflow.start", ['PARAMETERS' => $params, 'DOCUMENT_ID' => ['bizproc', 'CIBlockDocument', 133348], 'TEMPLATE_ID' => 554]) : '';
            }
            foreach ($dp2->value as $ndx => $item) {
                if (!$myitems[$item->ИНН] and $item->ИНН) {
                    $method2 = 'lists.element.add';
                    $params2['IBLOCK_TYPE_ID'] = 'bitrix_processes';
                    $params2['IBLOCK_ID'] = '192';
                    $params2['ELEMENT_CODE'] = $item->Code;
                    $params2['FIELDS']['PROPERTY_1984'] = (object) ['n0' => $item->ИНН];
                    $params2['FIELDS']['PROPERTY_3490'] = (object) ['n0' => $item->Code];
                    $params2['FIELDS']['PROPERTY_3488'] = (object) ['n0' => $item->Ref_Key];
                    $params2['FIELDS']['NAME'] = $item->Description . " (" . $item->ИНН . ")";
                    $result = (array) $load->getbtasks($method2, $params2);
                    //print_r($result);
                }
            }
            // print_r($myitems);
            // print_r($result1);
            break;
        case 'delpairs_deps':
            include 'clss.php';
            $load = new CLoader();
            $method1 = 'lists.element.get';
            $params1['IBLOCK_TYPE_ID'] = 'bitrix_processes';
            $params1['IBLOCK_ID'] = '260';
            $params1['ELEMENT_ORDER'] = ['ID' => 'DESC'];
            $count = 1500;
            $rounds = ceil($count / 50);
            $fullresult = [];
            $myitems = [];
            for ($i = 0; $i < $rounds; $i++) {
                $params1['start'] = $i * 50;
                $result = (array) $load->getbtasks($method1, $params1);
                $fullresult = array_merge($fullresult, $result['result']);
            }
            foreach ($fullresult as $ndx => $proccess) {
                //print_r($proccess);
                $ref = array_values((array) $proccess->PROPERTY_3322)[0];
                $ref ? $myitems[$ref][$proccess->ID] = $proccess->ID : '';
            }
            //print_r($myitems);
            foreach ($myitems as $key => $ref) {
                // echo count($ref)>1?array_keys($ref)[0]."\n":'';
                if (count($ref) > 1) {
                    print_r($ref);
                    //print_r($ref);
                    $pid = (int) array_keys($ref)[0];
                    $method2 = 'lists.element.delete';
                    $params2['IBLOCK_TYPE_ID'] = 'bitrix_processes';
                    $params2['IBLOCK_ID'] = '260';
                    $params2['ELEMENT_ID'] = $pid;
                    $result = (array) $load->getbtasks($method2, $params2);
                }
            }
            break;
        case 'delpairs_costitem':
            include 'clss.php';
            $load = new CLoader();
            $method1 = 'lists.element.get';
            $params1['IBLOCK_TYPE_ID'] = 'bitrix_processes';
            $params1['IBLOCK_ID'] = '258';
            $params1['ELEMENT_ORDER'] = ['ID' => 'DESC'];
            $count = 1500;
            $rounds = ceil($count / 50);
            $fullresult = [];
            $myitems = [];
            for ($i = 0; $i < $rounds; $i++) {
                $params1['start'] = $i * 50;
                $result = (array) $load->getbtasks($method1, $params1);
                $fullresult = array_merge($fullresult, $result['result']);
            }
            foreach ($fullresult as $ndx => $proccess) {
                //print_r($proccess);
                $ref = array_values((array) $proccess->PROPERTY_3318)[0];
                $ref ? $myitems[$ref][$proccess->ID] = $proccess->ID : '';
                $ref ? $myitems[$ref][$proccess->ID] = $proccess->NAME : '';
            }
            foreach ($myitems as $key => $ref) {
                // echo count($ref)>1?array_keys($ref)[0]."\n":'';
                if (count($ref) > 1) {
                    $pid = (int) array_keys($ref)[0];
                    $method2 = 'lists.element.delete';
                    $params2['IBLOCK_TYPE_ID'] = 'bitrix_processes';
                    $params2['IBLOCK_ID'] = '258';
                    asort($ref);
                    //print_r($ref);
                    array_pop($ref);
                    foreach ($ref as $pid => $name) {
                        //echo $pid."-".$name."\n";
                        $params2['ELEMENT_ID'] = $pid;
                        $result = (array) $load->getbtasks($method2, $params2);
                        unset($myitems[$key][$pid]);
                    }
                    //print_r($params2);
                }
            }
            break;
        case "clear_deps2":
            include '/var/www/html/returner/clss.php';
            $load = new CLoader();
            $method1 = 'lists.element.get';
            $params1['IBLOCK_TYPE_ID'] = 'bitrix_processes';
            $params1['IBLOCK_ID'] = '260';
            $params1['ELEMENT_ORDER'] = ['ID' => 'DESC'];
            $count = 2500;
            $rounds = ceil($count / 50);
            $fullresult = [];
            $myitems = [];
            for ($i = 0; $i < $rounds; $i++) {
                $params1['start'] = $i * 50;
                $result = (array) $load->getbtasks($method1, $params1);
                $fullresult = array_merge($fullresult, $result['result']);
            }
            foreach ($fullresult as $ndx => $proccess) {
                $ref = array_values((array) $proccess->PROPERTY_3322)[0];
                $code = array_values((array) $proccess->PROPERTY_3324)[0];
                $ref ? $myitems[$ref]['lid'] = $proccess->ID : '';
                $ref ? $myitems[$ref]['ref'] = $ref : '';
                $ref ? $myitems[$ref]['name'] = $proccess->NAME : '';
                $code ? $myitems[$ref]['code'] = $code : '';
                if (stristr($proccess->NAME, '<<') or stristr($proccess->NAME, '>>')) {
                    $method2 = 'lists.element.delete';
                    $params2['IBLOCK_TYPE_ID'] = 'bitrix_processes';
                    $params2['IBLOCK_ID'] = '260';
                    $params2['ELEMENT_ID'] = $proccess->ID;
                    $result = (array) $load->getbtasks($method2, $params2);
                }
            }
            if (count($myitems) > 10) {
                $deleted = $load->connect_torg('https://1c.pivzavoz.ru/pivzavoz_new/odata/standard.odata/Catalog_%D0%9F%D0%BE%D0%B4%D1%80%D0%B0%D0%B7%D0%B4%D0%B5%D0%BB%D0%B5%D0%BD%D0%B8%D1%8F?$format=json;odata=nometadata&$filter=%D0%BF%D0%B8%D0%B2%D0%90%D1%80%D1%85%D0%B8%D0%B2%D0%BD%D0%BE%D0%B5%20eq%20true%20or%20DeletionMark%20eq%20true', true);
                foreach ($deleted->value as $item) {
                    if ($myitems[$item->Ref_Key]) {
                        $method2 = 'lists.element.delete';
                        $params2['IBLOCK_TYPE_ID'] = 'bitrix_processes';
                        $params2['IBLOCK_ID'] = '260';
                        $params2['ELEMENT_ID'] = $myitems[$item->Ref_Key]['lid'];
                        $result = (array) $load->getbtasks($method2, $params2);
                    }
                }
            }
            break;
        case "clear_deps":
            include 'clss.php';
            $load = new CLoader();
            $method1 = 'lists.element.get';
            $params1['IBLOCK_TYPE_ID'] = 'bitrix_processes';
            $params1['IBLOCK_ID'] = '260';
            $params1['ELEMENT_ORDER'] = ['ID' => 'DESC'];
            $count = 2500;
            $rounds = ceil($count / 50);
            $fullresult = [];
            $myitems = [];
            $archive_deps = [];
            $archive_deps = findfolders_deps("e5ed2738-0a59-11e8-89d6-00155d7c2500");
            if (count($archive_deps) > 0) {
                for ($i = 0; $i < $rounds; $i++) {
                    $params1['start'] = $i * 50;
                    $result = (array) $load->getbtasks($method1, $params1);
                    $fullresult = array_merge($fullresult, $result['result']);
                }
                foreach ($fullresult as $ndx => $proccess) {
                    $ref = array_values((array) $proccess->PROPERTY_3322)[0];
                    $code = array_values((array) $proccess->PROPERTY_3324)[0];
                    $ref ? $myitems[$ref]['lid'] = $proccess->ID : '';
                    $ref ? $myitems[$ref]['ref'] = $ref : '';
                    $ref ? $myitems[$ref]['name'] = $proccess->NAME : '';
                    $code ? $myitems[$ref]['code'] = $code : '';
                }
                $dp = $load->connect_torg('https://1c.pivzavoz.ru/pivzavoz_new/odata/standard.odata/Catalog_%D0%9F%D0%BE%D0%B4%D1%80%D0%B0%D0%B7%D0%B4%D0%B5%D0%BB%D0%B5%D0%BD%D0%B8%D1%8F?$format=json;odata=nometadata');
                foreach ($dp->value as $item) {
                    if (in_array($item->Parent_Key, $archive_deps) or $item->DeletionMark) {
                        if ($myitems[$item->Ref_Key]) {
                            print_r($item);
                            $method2 = 'lists.element.delete';
                            $params2['IBLOCK_TYPE_ID'] = 'bitrix_processes';
                            $params2['IBLOCK_ID'] = '260';
                            $params2['ELEMENT_ID'] = $myitems[$item->Ref_Key]['lid'];
                            $result = (array) $load->getbtasks($method2, $params2);
                        }
                    } else {
                        if ($myitems[$item->Ref_Key]) {
                            if ($item->Description != $myitems[$item->Ref_Key]['name']) {
                                $method2 = 'lists.element.update';
                                $params2['IBLOCK_TYPE_ID'] = 'bitrix_processes';
                                $params2['IBLOCK_ID'] = '260';
                                $params2['ELEMENT_ID'] = $myitems[$item->Ref_Key]['lid'];
                                $params2['FIELDS']['PROPERTY_3324'] = (object) ['n0' => $item->Code];
                                $params2['FIELDS']['PROPERTY_3322'] = (object) ['n0' => $item->Ref_Key];
                                $params2['FIELDS']['NAME'] = $item->Description;
                                $result = (array) $load->getbtasks($method2, $params2);
                            }
                        }
                    }
                }
            }
            break;
        case "clear_payers":
            include 'clss.php';
            $load = new CLoader();
            $method1 = 'lists.element.get';
            $params1['IBLOCK_TYPE_ID'] = 'bitrix_processes';
            $params1['IBLOCK_ID'] = '260';
            $params1['ELEMENT_ORDER'] = ['ID' => 'DESC'];
            $count = 2500;
            $rounds = ceil($count / 50);
            $fullresult = [];
            $myitems = [];
            $archive_deps = [];
            for ($i = 0; $i < $rounds; $i++) {
                $params1['start'] = $i * 50;
                $result = (array) $load->getbtasks($method1, $params1);
                $fullresult = array_merge($fullresult, $result['result']);
            }
            foreach ($fullresult as $ndx => $proccess) {
                $inn = array_values((array) $proccess->PROPERTY_1984)[0];
                $ref = array_values((array) $proccess->PROPERTY_3488)[0];
                $code = array_values((array) $proccess->PROPERTY_3490)[0];
                $inn ? $myitems[$inn]['lid'] = $proccess->ID : '';
                $inn ? $myitems[$inn]['inn'] = $inn : '';
                $ref ? $myitems[$inn]['ref'] = $ref : '';
                $code ? $myitems[$inn]['code'] = $code : '';
                $inn ? $myitems[$inn]['name'] = $proccess->NAME : '';
            }
            $dp = $load->connect_torg('https://1c.pivzavoz.ru/pivzavoz_new/odata/standard.odata/Catalog_%D0%9E%D1%80%D0%B3%D0%B0%D0%BD%D0%B8%D0%B7%D0%B0%D1%86%D0%B8%D0%B8?$format=json;odata=nometadata');
            foreach ($dp->value as $item) {
                if ($item->DeletionMark) {
                    if ($myitems[$item->ИНН]) {
                        print_r($item);
                        // $method2 = 'lists.element.delete';
                        // $params2['IBLOCK_TYPE_ID'] = 'bitrix_processes';
                        // $params2['IBLOCK_ID'] = '260';
                        // $params2['ELEMENT_ID'] = $myitems[$item->Ref_Key]['lid'];
                        //$result = (array) $load->getbtasks($method2, $params2);
                    }
                }
            }
            break;
        case "clear_costitem":
            include 'clss.php';
            $load = new CLoader();
            $method1 = 'lists.element.get';
            $params1['IBLOCK_TYPE_ID'] = 'bitrix_processes';
            $params1['IBLOCK_ID'] = '258';
            $params1['ELEMENT_ORDER'] = ['ID' => 'DESC'];
            $count = 2500;
            $rounds = ceil($count / 50);
            $fullresult = [];
            $myitems = [];
            $archive_items = [];
            $archive_items = findfolders("5ac86679-0fdb-11e9-9d37-00155d7c2205");
            if (count($archive_items) > 0) {
                for ($i = 0; $i < $rounds; $i++) {
                    $params1['start'] = $i * 50;
                    $result = (array) $load->getbtasks($method1, $params1);
                    $fullresult = array_merge($fullresult, $result['result']);
                }
                foreach ($fullresult as $ndx => $proccess) {
                    $ref = array_values((array) $proccess->PROPERTY_3318)[0];
                    $type = array_values((array) $proccess->PROPERTY_3314)[0];
                    $folder = array_values((array) $proccess->PROPERTY_3316)[0];
                    $code = array_values((array) $proccess->PROPERTY_3320)[0];
                    $ref ? $myitems[$ref]['lid'] = $proccess->ID : '';
                    $ref ? $myitems[$ref]['name'] = $proccess->NAME : '';
                    $ref ? $myitems[$ref]['ref'] = $ref : '';
                    $code ? $myitems[$ref]['code'] = $code : '';
                    $folder ? $myitems[$ref]['folder'] = $folder : '';
                    $type ? $myitems[$ref]['type'] = $type : '';
                }
                $dp = $load->connect_torg('https://1c.pivzavoz.ru/pivzavoz_new/odata/standard.odata/Catalog_%D0%A1%D1%82%D0%B0%D1%82%D1%8C%D0%B8%D0%97%D0%B0%D1%82%D1%80%D0%B0%D1%82?$format=json;odata=nometadata&$filter=IsFolder%20eq%20false%20');
                foreach ($dp->value as $item) {
                    if (in_array($item->Parent_Key, $archive_items) or $item->DeletionMark) {
                        if ($myitems[$item->Ref_Key]) {
                            $method2 = 'lists.element.delete';
                            $params2['IBLOCK_TYPE_ID'] = 'bitrix_processes';
                            $params2['IBLOCK_ID'] = '258';
                            $params2['ELEMENT_ID'] = $myitems[$item->Ref_Key]['lid'];
                            //$result = (array) $load->getbtasks($method2, $params2);
                        }
                    } else {
                        if ($myitems[$item->Ref_Key]) {
                            if ($item->ХарактерЗатрат != $myitems[$item->Ref_Key]['type'] || $item->Description != $myitems[$item->Ref_Key]['name'] || $item->ВидЗатрат != $myitems[$item->Ref_Key]['folder']) {
                                $method2 = 'lists.element.update';
                                $params2['IBLOCK_TYPE_ID'] = 'bitrix_processes';
                                $params2['IBLOCK_ID'] = '258';
                                $params2['ELEMENT_ID'] = $myitems[$item->Ref_Key]['lid'];
                                $params2['FIELDS']['PROPERTY_3314'] = (object) ['n0' => $item->ХарактерЗатрат];
                                $params2['FIELDS']['PROPERTY_3316'] = (object) ['n0' => $item->ВидЗатрат];
                                $params2['FIELDS']['PROPERTY_3320'] = (object) ['n0' => $item->Code];
                                $params2['FIELDS']['PROPERTY_3318'] = (object) ['n0' => $item->Ref_Key];
                                $params2['FIELDS']['NAME'] = $item->Description;
                                print_r($params2);
                                $result = (array) $load->getbtasks($method2, $params2);
                            }
                        }
                    }
                }
            }
            break;
        case "dataslice":
            include 'clss.php';
            $day = date("d-m-Y");
            $reports = file_exists("/var/www/html/retail/tsdreport/" . $day . ".json") ? json_decode(file_get_contents("/var/www/html/retail/tsdreport/" . $day . ".json"), true) : [];
            $data = json_decode(file_get_contents("https://tsd.pivko24.ru/slices/" . $day . ".json"));
            foreach ($data as $refkey => $doc) {
                //if (array_key_exists($refkey, $reports) and ($doc->lastload) < $reports[$refkey]['loaded'] and $reports[$refkey]['error'] == "OK") {
                if (array_key_exists($doc->Ref_Key_Original, $reports)) {
                    if (gettype($data) === 'object') {
                        unset($data->$refkey);
                    } else {
                        unset($data[$refkey]);
                    }
                } else {
                    $doc->Ref_Key = $doc->Ref_Key_Original;
                }
                unset($doc->history);
                unset($doc->goods);
                //  print_r($data);
                foreach ($doc->items as $ndx2 => $item) {
                    $item->refkey = $item->Ref_Key;
                    !array_key_exists('q_finded', $item) && $item->q_finded = 0;
                }
            }
            $result = [];
            foreach ($data as $ndx => $order) {
                !array_key_exists($order->stock, $result) ? $result[$order->stock] = [] : '';
                $result[$order->stock][] = $order;
            }
            foreach ($result as $key => $pack) {
                //  print_r($pack);
            }
            $result = json_decode(json_encode($result), false);
            //echo json_encode($result, JSON_UNESCAPED_UNICODE);
            $curl = curl_init();
            $url = "https://1c.pivzavoz.ru/pivzavoz_new/hs/pivHTTP/dataslice";
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_USERPWD, "TSDonload:26hD1.F4");
            //curl_setopt ($curl, CURLOPT_USERPWD, "ХаматнуровВХ:12369874");
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($result));
            $response = curl_exec($curl);
            curl_close($curl);
            print_r($response);
            $rr = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response);
            $rr = json_decode($rr, true);
            if (gettype($rr) != 'array' and gettype($response) === 'string') {
                foreach ($result as $stock_type => $pack) {
                    foreach ($pack as $ndx => $order) {
                        $doc = [];
                        $doc['Ref_Key'] = $order->Ref_Key;
                        $doc['error'] = $response;
                        $doc['loaded'] = time();
                        !array_key_exists($doc['Ref_Key'], $reports) ? $reports[$doc['Ref_Key']] = $doc : '';
                    }
                }
            } else if (gettype($rr) === 'array' and gettype($response) === 'string') {
                foreach ($rr as $ndx => $resp) {
                    foreach ($resp as $stocktype => $pack) {
                        foreach ($pack as $ndx2 => $doc) {
                            $doc['loaded'] = time();
                            !array_key_exists($doc['Ref_Key'], $reports) ? $reports[$doc['Ref_Key']] = $doc : '';
                        }
                    }
                }
            }
            file_put_contents("/var/www/html/retail/tsdreport/" . $day . ".json", json_encode($reports, JSON_UNESCAPED_UNICODE));
            break;
        case "dataslice2":
            //include 'clss.php';
            $day = "07-10-2019";
            $reports = file_exists("/var/www/html/retail/tsdreport/" . $day . ".json") ? json_decode(file_get_contents("/var/www/html/retail/tsdreport/" . $day . ".json"), true) : [];
            $data = json_decode(file_get_contents("https://tsd.pivko24.ru/slices/" . $day . ".json"));
            foreach ($data as $refkey => $doc) {
                //if (array_key_exists($refkey, $reports) and ($doc->lastload) < $reports[$refkey]['loaded'] and $reports[$refkey]['error'] == "OK") {
                if (!array_key_exists($refkey, $reports)) {
                    if (gettype($data) === 'object') {
                        unset($data->$refkey);
                    } else {
                        unset($data[$refkey]);
                    }
                }
            }
            $result = [];
            foreach ($data as $ndx => $order) {
                !array_key_exists($order->stock, $result) ? $result[$order->stock] = [] : '';
                $result[$order->stock][] = $order;
            }
            $result = json_decode(json_encode($result), false);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            //file_put_contents("/var/www/html/retail/tsdreport/" . $day . ".json", json_encode($reports, JSON_UNESCAPED_UNICODE));
            break;
        case "removestop":
            include 'clss.php';
            $load = new CLoader();
            $params = array('INN' => $inns);
            $curl = curl_init();
            $url = "https://1c.pivzavoz.ru/pivzavoz_new/hs/pivHTTP/RemoveStopMoney";
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_USERPWD, "RoznUser:CbvCbvJnrhjqcz");
            //curl_setopt ($curl, CURLOPT_USERPWD, "ХаматнуровВХ:12369874");
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
            $rr = curl_exec($curl);
            curl_close($curl);
            // [{"INN":"662103190577","Name":"Борисов Е.В. ИП ХолдинГ","Remove":true}]
            // echo $rr = '﻿[{"INN":"662103190577","Name":"Борисов Е.В. ИП ХолдинГ","Remove":true}]';
            if (substr_compare($rr, "\xEF\xBB\xBF", 0) > 0) {
                $rr = substr($rr, 3);
            }
            if (is_array(json_decode($rr)) or is_object(json_decode($rr))) {
                $response = (array) json_decode($rr)[0];
                $params2['desc'] = urldecode($response['Name']);
                $params2['inn'] = $response['INN'];
                $params2['data'] = date('Y-m-d H:i:s');
            } else {
                $params2['desc'] = 'Произошла ошибка';
                $params2['inn'] = $inns;
                $params2['error'] = urldecode($rr);
            }
            $result2 = $load->getbtasks2("bizproc.workflow.start", ['PARAMETERS' => $params2, 'DOCUMENT_ID' => ['bizproc', 'CIBlockDocument', 152210], 'TEMPLATE_ID' => 692]);
            break;
        case "newcontract":
            include 'clss.php';
            $load = new CLoader();
            $method1 = 'lists.element.get';
            $params1['IBLOCK_TYPE_ID'] = 'bitrix_processes';
            $costitem = $_GET['costitem'];
            $payer = $_GET['payer'];
            $dep = $_GET['dep'];
            $amount = $_GET['amount'];
            $date = $_GET['date'];
            $num = $_GET['num'];
            $ainn = $_GET['ainn'];
            $desc = $_GET['desc'];
            $params1['IBLOCK_ID'] = '258';
            $params1['ELEMENT_ID'] = $costitem;
            $result = (array) $load->getbtasks($method1, $params1);
            $costitem = array_values((array) $result['result'][0]->PROPERTY_3318)[0];
            $params1['IBLOCK_ID'] = '192';
            $params1['ELEMENT_ID'] = $payer;
            $result = (array) $load->getbtasks($method1, $params1);
            $payer_inn = array_values((array) $result['result'][0]->PROPERTY_1984)[0];
            $payer_ref = array_values((array) $result['result'][0]->PROPERTY_3488)[0];
            $contract['payer_inn'] = $payer_inn;
            $contract['payer_ref'] = $payer_ref;
            $contract['costitem'] = $costitem;
            $contract['desc'] = $desc;
            $contract['ainn'] = $ainn;
            $contract['num'] = $num;
            $contract['date'] = $date;
            $contract['amount'] = $amount;
            file_put_contents(getcwd() . '/hooks.txt', json_encode($contract, JSON_UNESCAPED_UNICODE), FILE_APPEND);
            break;
    }
}
function findfolders($startref)
{
    global $load;
    $i = 1;
    $ff[$i][] = $startref; //***Архив;
    do {
        $result = [];
        foreach ($ff[$i] as $ref) {
            $dp = $load->connect_torg('https://1c.pivzavoz.ru/pivzavoz_new/odata/standard.odata/Catalog_%D0%A1%D1%82%D0%B0%D1%82%D1%8C%D0%B8%D0%97%D0%B0%D1%82%D1%80%D0%B0%D1%82?$format=json;odata=nometadata&$filter=IsFolder%20eq%20true%20and%20DeletionMark%20eq%20false%20and%20Parent_Key%20eq%20guid%27' . $ref . '%27&$select=Ref_Key,Parent_Key,Description');
            if (count($dp->value) > 0) {
                $result = (array) $dp->value;
                $i++;
                foreach ($result as $folder) {
                    $ff[$i][] = $folder->Ref_Key;
                    $archive_items[] = $folder->Ref_Key;
                }
            }
        }
    } while (count($result) > 0);
    $archive_items[] = $startref;
    return $archive_items;
}
function findfolders_deps($startref)
{
    global $load;
    $i = 1;
    $ff[$i][] = $startref; //***Архив;
    do {
        $result = [];
        foreach ($ff[$i] as $ref) {
            $dp = $load->connect_torg('https://1c.pivzavoz.ru/pivzavoz_new/odata/standard.odata/Catalog_%D0%9F%D0%BE%D0%B4%D1%80%D0%B0%D0%B7%D0%B4%D0%B5%D0%BB%D0%B5%D0%BD%D0%B8%D1%8F?%24format=json%3Bodata%3Dnometadata&%24filter=DeletionMark+eq+false+and+Parent_Key+eq+guid%27' . $ref . '%27');
            if (count($dp->value) > 0) {
                $i++;
                foreach ($dp->value as $folder) {
                    if ($folder->Parent_Key === $ref) {
                        $ff[$i][] = $folder->Ref_Key;
                        $archive_items[] = $folder->Ref_Key;
                        $result[] = $folder;
                    }
                }
            }
        }
    } while (count($result) > 0);
    $archive_items[] = $startref;
    return $archive_items;
}
