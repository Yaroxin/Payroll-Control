<?php
require_once "functions.php";
$settings = R::findAll('settings');

$APP_NAME = 'Payroll Control';
$VERSION = "0.9.1 Beta";

$RATE = $settings[1]['value'];
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
    'hourlypay'     => '0',
    'extrashift'     => '300',
    'bonusBlock'     => '0',
    'productBlock'     => '0',
];

$defaultItems = [
    'item1' => 'Изделие1',
    'item2' => 'Изделие2',
    'item3' => 'Изделие3',
    'item4' => 'Изделие4',
    'item5' => 'Изделие5',
];

?>