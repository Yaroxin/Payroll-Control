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
$item5Count = 0;

$stCost = 0;
$pvCost = 0;
$pnCost = 0;
$noCost = 0;
$item5Cost = 0;

$bending = R::findOne('bending', 'date = ?', [$dateOfGet]);
$items = R::findAll('item');

$itemRows = [
    [
        "name" => $items[1]['name'],
        "title" => $items[1]['title'],
        "count" => $bending['item1count'],
        "cost" => $bending['item1cost'],
        "factor" => $bending['item1factor'],
    ],
    [
        "name" => $items[2]['name'],
        "title" => $items[2]['title'],
        "count" => $bending['item2count'],
        "cost" => $bending['item2cost'],
        "factor" => $bending['item2factor'],
    ],
    [
        "name" => $items[3]['name'],
        "title" => $items[3]['title'],
        "count" => $bending['item3count'],
        "cost" => $bending['item3cost'],
        "factor" => $bending['item3factor'],
    ],
    [
        "name" => $items[4]['name'],
        "title" => $items[4]['title'],
        "count" => $bending['item4count'],
        "cost" => $bending['item4cost'],
        "factor" => $bending['item4factor'],
    ],
    [
        "name" => $items[5]['name'],
        "title" => $items[5]['title'],
        "count" => $bending['item5count'],
        "cost" => $bending['item5cost'],
        "factor" => $bending['item5factor'],
    ],
];








if($bending){
    $bendingHours = $bending['hours'];
    $bendingBonus = $bending['bonus'];
    $bendingFine = $bending['fine'];

    $hourlyPay = $bending['hourlypay'];

    $stCount = $bending['st'];
    $pvCount = $bending['pv'];
    $pnCount = $bending['pn'];
    $noCount = $bending['no'];
    $item5Count = $bending['item5']; 

    $stCost = $bending['stcost'];
    $pvCost = $bending['pvcost'];
    $pnCost = $bending['pncost'];
    $noCost = $bending['nocost']; 
    $item5Cost = $bending['item5cost']; 
    
    if($hourlyPay == 0){
        $bendingPay = $bendingPay +
        ((($bending['st'] * $bending['stcost']) +
        ($bending['pv'] * $bending['pvcost']) +
        ($bending['pn'] * $bending['pncost']) +
        ($bending['no'] * $bending['nocost']) +
        ($bending['item5'] * $bending['item5cost']) +
        ($bending['bonus'])) - ($bending['fine'])) + $bending['extrashift'];
    }else{
        $bendingPay = ((($bendingHours * $hourlyPay) + $bending['bonus']) - $bending['fine']) + $bending['extrashift'];
    }
}

$totalHours = $hourlyHours + $bendingHours;
$totalPay = number_format($bendingPay, 0, ',', ' ');
$totalPPH = round($bendingPay / $totalHours);

?>