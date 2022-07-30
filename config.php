<?php

$APP_NAME = 'Payroll Control';
$VERSION = "0.9 Beta";

$RATE = 65;
$RATE_PER_HOUR = $RATE / 11 ;

$url_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
$page = $url_parts[0];


if (isset($_GET["month"]) && isset($_GET["year"])){
    $selectDate = getdate(strtotime($_GET['year'].'-'.$_GET['month']));
}else{
    $selectDate = getdate();
}

$dateOfGet = date( "Y-m-d", strtotime($_GET['year'].'-'.$_GET['month'].'-'.$_GET['day'] ) );

$defaultSettings = [
    'itemName1' => 'Item #1',
    'itemName2' => 'Item #2',
    'itemName3' => 'Item #3',
    'itemName4' => 'Item #4',
    'itemCost1' => '0',
    'itemCost2' => '0',
    'itemCost3' => '0',
    'itemCost4' => '0',
    'rate'      => '0',
    'bonus'     => '0',
    'hourlyPay'     => '0',
    'extraShift'     => '300',
];

$ruMonthsName = [
    'Январь',
    'Февраль',
    'Март',
    'Апрель',
    'Май',
    'Июнь',
    'Июль',
    'Август',
    'Сентябрь',
    'Октябрь',
    'Ноябрь',
    'Декабрь'
  ];

?>