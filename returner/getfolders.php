<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/json; charset=utf-8');
$start = microtime(true);
include 'clss.php';
$load = new CLoader();

/* $result = [];
$fg = $load->connect_torg('https://1c.pivzavoz.ru/pivzavoz_new/odata/standard.odata/InformationRegister_%D0%A8%D1%82%D1%80%D0%B8%D1%85%D0%BA%D0%BE%D0%B4%D1%8B?$format=json;odata=nometadata&$select=%D0%A8%D1%82%D1%80%D0%B8%D1%85%D0%BA%D0%BE%D0%B4,%D0%95%D0%B4%D0%B8%D0%BD%D0%B8%D1%86%D0%B0%D0%98%D0%B7%D0%BC%D0%B5%D1%80%D0%B5%D0%BD%D0%B8%D1%8F_Key,%D0%92%D0%BB%D0%B0%D0%B4%D0%B5%D0%BB%D0%B5%D1%86');
foreach ($fg->value as $ndx => $item) {
!$result[$item->Владелец] ? $result[$item->Владелец] = [] : null;
!$result[$item->Владелец][$item->Штрихкод] ? $result[$item->Владелец][$item->Штрихкод] = [] : null;
$result[$item->Владелец][$item->Штрихкод]['ean'] = $item->Штрихкод;
$result[$item->Владелец][$item->Штрихкод]['measure_key'] = $item->ЕдиницаИзмерения_Key;
}
file_put_contents('/var/www/html/retail/mainfolders.json', json_encode($result, JSON_UNESCAPED_UNICODE)); */

$mainfolders = ["27e8cb40-24e3-11de-b8a5-00164475d53a", "d2f8b471-d676-11de-a74a-00242150a4cd", "e1275d55-27f0-11de-b8b1-00164475d53a", "515f2112-e319-11de-958d-00242150a4cd", "27e8cb47-24e3-11de-b8a5-00164475d53a", "c5cc4960-e867-11de-ad2b-00242150a4cd", "5122fb2a-280e-11de-b8b2-00164475d53a", "1f2e82e0-5273-11e3-9c16-f2d21107f511", "cb3a0699-7a5b-11de-8a48-00242150a4cd", "0e0b35d0-297e-11e2-a836-525400170130", "d882b031-1ed0-11e4-a9ef-f2d21107f511", "6b60d3ca-bc78-11de-8a48-00242150a4cd"];

$archive_items = [];

foreach ($mainfolders as $mfolder) {
    findfolders($mfolder);
}

function findfolders($startref)
{
    global $load;
    global $archive_items;
    $i = 1;
    $ff[$i][] = $startref; //***Архив;
    do {
        $result = [];
        foreach ($ff[$i] as $ref) {
            $dp = $load->connect_torg('https://1c.pivzavoz.ru/pivzavoz_new/odata/standard.odata/Catalog_Номенклатура?$format=json;odata=nometadata&$select=Description,Ref_Key&$filter=IsFolder%20eq%20true%20and%20DeletionMark%20eq%20false%20and%20Parent_Key%20eq%20guid%27' . $ref . '%27', true);
            if (count($dp->value) > 0) {
                $result = (array) $dp->value;
                $i++;
                foreach ($result as $folder) {

                    $ff[$i][] = $folder->Ref_Key;
                    $item = ["Ref_Key" => $folder->Ref_Key, "name" => $folder->Description];
                    $archive_items[] = $item;
                }
            }
        }
    } while (count($result) > 0);
    $archive_items[] = $startref;
    return $archive_items;
}

print_r($archive_items);

$time = microtime(true) - $start;
printf('Скрипт выполнялся %.4F сек.', $time);

//СкладСнеки
//СкладПиво
//СкладСигареты
//СкладХолод
//СкладОборудование
