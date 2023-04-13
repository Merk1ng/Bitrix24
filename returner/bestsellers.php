<?php
header('Content-Type: text/json; charset=utf-8');
$files = [];

echo $today = date("Y-m-d");

$files[]=$today;

for ($i = 1; $i < 60; $i++) {

    $tomorrow = date('Y-m-d', strtotime($today . ' - ' . $i . ' days')) ;
    $files[]=$tomorrow;
}



$report=[];
foreach($files as $file){
   // echo 'https://pivko24.ru/orders/'.$file.'.json';
    //echo file_exists('https://pivko24.ru/orders/'.$file.'.json')?$file:'nofile'."\n";
    $orders = json_decode( file_get_contents('https://pivko24.ru/orders/'.$file.'.json'),true);
     foreach($orders as $ndx=>$order){
        foreach($order['cart'] as $code=>$item){
            !array_key_exists($code,$report)?$report[$code]=0:'';
                $report[$code]=$report[$code]+$item['qua'];
        }
     }

}
asort($report);

print_r($report);
