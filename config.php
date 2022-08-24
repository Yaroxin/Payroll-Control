<?php

//123

$APP_NAME = 'Payroll Control';
$VERSION = "0.9.1 Beta";

$RATE = 65;
$RATE_PER_HOUR = $RATE / 11 ;

$url_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
$page = $url_parts[0];

if($_SERVER['SERVER_NAME'] != '3.144.142.223'){
    $devClass = 'devClass';
}



if (isset($_GET["month"]) && isset($_GET["year"])){
    $selectDate = getdate(strtotime($_GET['year'].'-'.$_GET['month']));
}else{
    $selectDate = getdate();
}

$dateOfGet = date( "Y-m-d", strtotime($_GET['year'].'-'.$_GET['month'].'-'.$_GET['day'] ) );

$defaultSettings = [
    'rate'      => '0',
    'bonus'     => '0',
    'hourlyPay'     => '0',
    'extraShift'     => '0',
    'bonusBlock'     => '0',
    'productBlock'     => '0',
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