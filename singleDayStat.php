<?php
$totalHours = 0;
$totalPay = 0;
$totalPPH = 0;

$bendingPay = 0;
$bendingFine = 0;
$bendingBonus = 0;
$bendingHours = 0;
$bendingPPH = 0;

$payforhour = 0;
$payperhour = 0;

$stCount = 0;
$pvCount = 0;
$pnCount = 0;
$noCount = 0;

$stCost = 0;
$pvCost = 0;
$pnCost = 0;
$noCost = 0;

$bending = R::findOne('bending', 'date = ?', [$dateOfGet]);

if($bending){
    $bendingHours = $bending['hours'];
    $bendingBonus = $bending['bonus'];
    $bendingFine = $bending['fine'];

    $hourlyPay = $bending['hourlypay'];

    $stCount = $bending['st'];
    $pvCount = $bending['pv'];
    $pnCount = $bending['pn'];
    $noCount = $bending['no'];

    $stCost = $bending['stcost'];
    $pvCost = $bending['pvcost'];
    $pnCost = $bending['pncost'];
    $noCost = $bending['nocost']; 
    
    if($hourlyPay == 0){
        $bendingPay = $bendingPay +
        ((($bending['st'] * $bending['stcost']) +
        ($bending['pv'] * $bending['pvcost']) +
        ($bending['pn'] * $bending['pncost']) +
        ($bending['no'] * $bending['nocost']) +
        ($bending['bonus'])) - ($bending['fine'])) + $bending['extrashift'];
    }else{
        $bendingPay = ((($bendingHours * $hourlyPay) + $bending['bonus']) - $bending['fine']) + $bending['extrashift'];
    }
}

$totalHours = $hourlyHours + $bendingHours;
$totalPay = number_format($bendingPay, 0, ',', ' ');
$totalPPH = round($bendingPay / $totalHours);

?>