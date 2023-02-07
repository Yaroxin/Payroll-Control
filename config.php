<?php
require_once "functions.php";
$settings = R::findAll('settings');

$APP_NAME = 'Payroll Control';
$VERSION = "0.9.4 Beta";

$RATE = $settings[1]['value'];
$RATE_PER_HOUR = round(($RATE / 11), 2);
$THEORETICAL_SALARY =  (15 * 11) * $settings[3]['value']; //Базовый оклад. 15 смен по 11 часов умножено на стоимость часа.

$MIN_BONUS = intval($settings[2]['value']); // Минимальный процент премии. Ниже него премия не начисляется.

$url_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
$page = $url_parts[0];

if($_SERVER['SERVER_NAME'] != '194.87.99.129'){
    $devClass = 'devClass';
}

if (isset($_GET["month"]) && isset($_GET["year"])){
    $selectDate = getdate(strtotime($_GET['year'].'-'.$_GET['month']));
}else{
    $selectDate = getdate();
}

$dateOfGet = date( "Y-m-d", strtotime($_GET['year'].'-'.$_GET['month'].'-'.$_GET['day'] ) );

$defaultSettings = [
    'rate'           => '0',
    'bonus'          => '0',
    'hourlypay'      => '0',
    'extrashift'     => '300',
    'bonusBlock'     => '0',
    'productBlock'   => '0',
    'bonusCalcBlock' => '1',
];

$defaultItems = [
    'item1' => 'Изделие1',
    'item2' => 'Изделие2',
    'item3' => 'Изделие3',
    'item4' => 'Изделие4',
    'item5' => 'Изделие5',
];

?>