<?php

$totalHours = 0;
$totalPay = 0;
$totalPPH = 0;
$totalRate = 0;
$upRate = 0;
$bonus = 0;
$product = 0;

$bendingPay = 0;
$bendingFine = 0;
$bendingBonus = 0;
$bendingHours = 0;
$bendingPPH = 0;

$stCount = 0;
$pvCount = 0;
$pnCount = 0;
$noCount = 0;

$workShifts = [];
$allMonths = [];

$bendings = R::getAll( "SELECT * FROM `bending` WHERE MONTH(date) = ".$selectDate['mon']." AND YEAR(date) =" .$selectDate['year']);


$paymentDate = $selectDate['month'] .' '.$selectDate['year'];
$payment = R::findOne('payments', 'date = ?', [$paymentDate]);

$bendingsDates = R::getCol( "SELECT DATE_FORMAT(date, '%M %Y') FROM `bending`");

foreach($bendingsDates as $date){
    array_push($allMonths, $date);
}

$allMonths = array_unique($allMonths);

function sortFunction( $a, $b ) {
    return strtotime($b) - strtotime($a);
}

usort($allMonths, "sortFunction");

///// Start Bending Stat /////
if($bendings){
    foreach($bendings as $bending){
        array_push($workShifts, $bending['date']);

        $bendingHours = $bendingHours + $bending['hours'];
        $bendingBonus = $bendingBonus + $bending['bonus'];
        $bendingFine = $bendingFine + $bending['fine'];
        
        $stCount = $stCount + $bending['st'];
        $pvCount = $pvCount + $bending['pv'];
        $pnCount = $pnCount + $bending['pn'];
        $noCount = $noCount + $bending['no']; 
        
        if($bending['hourlypay'] == 0){
            $bendingPay = $bendingPay +
            (($bending['st'] * $bending['stcost']) +
            ($bending['pv'] * $bending['pvcost']) +
            ($bending['pn'] * $bending['pncost']) +
            ($bending['no'] * $bending['nocost']) +
            ($bending['bonus'])) - ($bending['fine']); 
        }else{
            $bendingPay = $bendingPay + (((($bending['hours'] * $bending['hourlypay']) + $bending['bonus']) - $bending['fine'])) + $bending['extrashift'];
        }
        
               
    }
}
///// End Bending Stat /////

///// Start TOTAL Stat /////
$totalHours = ($hourlyHours + $bendingHours);
$totalPay = ($hourlyPay + $bendingPay);

if ($totalHours > 0){
    $totalPPH = round($totalPay / $totalHours);
} else {
    $totalPPH = 0;
}

// $product = (($stCount * 0.6) + ($pvCount * 0.2) + ($pnCount * 0.2) + ($noCount * 0.2)) - 0.5;
$product = $stCount;

$totalRate = $totalHours * $RATE_PER_HOUR;


if ($totalRate > 0){
    $upRate = (($totalRate *1.1) + 0.5) - $product;
    if(($product / $totalRate) > 1){
        $bonus = 10;
    }else{
        $bonus = 0;
    }
}else{
    $upRate = 0;
    $bonus = 0;
}
$amountPay = $payment['prepaid'] + $payment['salary'] + $payment['bonus'];
$diffPay = $amountPay - $totalPay;

///// End TOTAL Stat /////


$workShifts = array_unique($workShifts);
usort($workShifts, "sortFunction");

$hourlyHours = number_format($hourlyHours, 1, ',', ' ');
$hourlyPay = number_format($hourlyPay, 0, ',', ' ');

$bendingHours = number_format($bendingHours, 1, ',', ' ');
$bendingPay = number_format($bendingPay, 0, ',', ' ');

$totalHours = number_format($totalHours, 1, ',', ' ');
$totalPay = number_format($totalPay, 0, ',', ' ');

$totalRate = number_format($totalRate, 0, ',', ' ');
$upRate = number_format($upRate, 0, ',', ' ');
$product = number_format($product, 0, ',', ' ');



if($payment){
    $payData = 1;
    $prepaid = number_format($payment['prepaid'], 0, ',', ' ');
    $salary = number_format($payment['salary'], 0, ',', ' ');
    $dopBonus = number_format($payment['bonus'], 0, ',', ' ');
    $amountPay = number_format($amountPay, 0, ',', ' ');
}else{
    $payData = 0;
    $prepaid = 0;
    $salary = 0;
    $dopBonus = 0;
    $amountPay = 0;
    $diffPay = 0;    
}


?>