<?php

$totalHours = 0; // Общее кол-во отработынных часов.
$totalPay = 0; // Общая сумма. Включает все доп. и премии.

$totalPPH = 0;
$totalRate = 0;
$totalItems = 0;
$upRate = 0;
$bonus = 0;
$product = 0;
$TotalItemsPerHour = 0;
$TotalMoneyPerItem = 0;

$bendingPay = 0;
$bendingFine = 0;
$bendingBonus = 0;
$bendingExtraShift = 0;
$bendingHours = 0;
$bendingPPH = 0;
$monthlyBonus = 0;

$stCount = 0;
$pvCount = 0;
$pnCount = 0;
$noCount = 0;
$item5Count = 0;

$workShifts = [];
$allMonths = [];

$bendings = R::getAll( "SELECT * FROM `bending` WHERE MONTH(date) = ".$selectDate['mon']." AND YEAR(date) =" .$selectDate['year']);
$items = R::findAll('item');

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

        $bendingHours += $bending['hours'];
        $bendingBonus += $bending['bonus'];
        $bendingExtraShift += $bending['extrashift'];
        $bendingFine += $bending['fine'];
        $payPerHours += $bending['hours'] * $bending['hourlypay'];
        
        $stCount += $bending['item1count'];
        $pvCount += $bending['item2count'];
        $pnCount += $bending['item3count'];
        $noCount += $bending['item4count']; 
        $item5count += $bending['item5count'];

        $product += ($bending['item1count'] * $bending['item1factor']) +
                    ($bending['item2count'] * $bending['item2factor']) +
                    ($bending['item3count'] * $bending['item3factor']) +
                    ($bending['item4count'] * $bending['item4factor']) +
                    ($bending['item5count'] * $bending['item5factor']);
              
        if($bending['hourlypay'] == 0){
            $bendingPay +=
                (($bending['item1count'] * $bending['item1cost']) +
                ($bending['item2count'] * $bending['item2cost']) +
                ($bending['item3count'] * $bending['item3cost']) +
                ($bending['item4count'] * $bending['item4cost']) +
                ($bending['item5count'] * $bending['item5cost']) +
                ($bending['bonus'])) - ($bending['fine']); 
        }             
    }

    $bendingPay = ($payPerHours + $bendingBonus + $bendingExtraShift) - $bendingFine;

    if($product){
        $monthlyBonus = 0;
    }
}
///// End Bending Stat /////



///// Start TOTAL Stat /////
$totalHours = ($hourlyHours + $bendingHours);
$totalRate = $totalHours * $RATE_PER_HOUR;

if ($totalHours > 0){
    $TotalItemsPerHour = round($product / $totalHours, 2);
} else {
    $TotalItemsPerHour = 0;
}

if ($totalRate > 0){
    $upRate = (($totalRate * 1.1) + 0.5) - $product;

    if( ($product / $totalRate) >= 1 ){
        // $bonus = intval((($product / $totalRate) - 1) * 100);
        $bonus = intval( (($TotalItemsPerHour / $RATE_PER_HOUR) - 1) * 100 );
    }else{
        $bonus = 0;
    }
    
    if($upRate <= 0){
        $upRate = 0;
    }else{
        $bonus = 0;
    }
    
}else{
    $upRate = 0;
    $bonus = 0;
}

$totalPay = ($hourlyPay + $bendingPay) + ($payPerHours * ($bonus / 100));

if ($totalHours > 0){
    $totalPPH = round($totalPay / $totalHours);
} else {
    $totalPPH = 0;
}

if ($product > 0){
    $TotalMoneyPerItem = $totalPay / $product;
} else {
    $TotalMoneyPerItem = 0;
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

$totalRate = number_format($totalRate, 1, ',', ' ');
$upRate = number_format($upRate, 1, ',', ' ');
$product = number_format($product, 1, ',', ' ');

$TotalItemsPerHour = number_format($TotalItemsPerHour, 2, ',', ' ');
$TotalMoneyPerItem = number_format($TotalMoneyPerItem, 2, ',', ' ');


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