<?php
$BendingSumm = 0;
$HourlyPaySumm = 0;
$WorkDayHours = 0; 
$bendingHours = 0; 
$hourlyHours = 0; 
$payPerHour = 0; 

foreach($WorkDays as $WorkDay){
    include_once "getDefPercent.php"; 

    $WorkDayHours = $WorkDayHours +( $WorkDay['hours'] );
    
    if($WorkDay['worktype'] == 'Bending' || $WorkDay['worktype'] == 'Bending-Night'){
        $costSumm = $WorkDay['stcost'] + $WorkDay['pvcost'] + $WorkDay['pncost'] + $WorkDay['oncost'] + $WorkDay['nocost'];

        if(isset($WorkDay['stcost']) & $costSumm != 0){
            $stCost = $WorkDay['stcost'];
        }else {
            $stCostStyle = "defaultValue";
        }

        if(isset($WorkDay['pvcost']) & $costSumm != 0){
            $pvCost = $WorkDay['pvcost'];
        }else {
            $pvCostStyle = "defaultValue";
        }

        if(isset($WorkDay['pncost']) & $costSumm != 0){
            $pnCost = $WorkDay['pncost'];
        }else {
            $pnCostStyle = "defaultValue";
        }

        if(isset($WorkDay['oncost']) & $costSumm != 0){
            $onCost = $WorkDay['oncost'];
        }else {
            $onCostStyle = "defaultValue";
        }

        if(isset($WorkDay['nocost']) & $costSumm != 0){
            $noCost = $WorkDay['nocost'];
        }else {
            $noCostStyle = "defaultValue";
        }
        
        $bendingHours = $bendingHours + $WorkDay['hours'];
        $BendingSumm = round($BendingSumm +
        (($WorkDay['stoyki'] * $stCost) +
        ($WorkDay['perekladinav'] * $pvCost) +
        ($WorkDay['perekladinan'] * $pnCost) +
        ($WorkDay['obnal'] * $onCost) +
        ($WorkDay['nalok'] * $noCost) +
        ($WorkDay['rub'])) -
        ($WorkDay['fine']));
    } 
    
    if($WorkDay['worktype'] == 'HourlyPay' || $WorkDay['worktype'] == 'HourlyPay-Night'){

        $hourlyHours = $hourlyHours + $WorkDay['hours'];
        $HourlyPaySumm = round($HourlyPaySumm +
        (($WorkDay['hours'] * $WorkDay['rubperhour']) + ($WorkDay['rub']) - ($WorkDay['fine'])));
    }
}

$WorkDaySumm = number_format(($BendingSumm + $HourlyPaySumm), 0, ',', ' ');
$payPerHour = round(($BendingSumm + $HourlyPaySumm) / $WorkDayHours);

?>