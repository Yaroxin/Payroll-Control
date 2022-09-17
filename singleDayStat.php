<?php
    $bending = R::findOne('bending', 'date = ?', [$dateOfGet]);
    $items = R::findAll('item');

    $itemRows = [];
    for($i = 1; $i <= 5; $i++){
        $item['name'] = $items[$i]['name'];
        $item['title'] = $items[$i]['title'];
        $item['count'] = $bending['item' .$i. 'count'];
        $item['cost'] = $bending['item' .$i. 'cost'];
        $item['factor'] = $bending['item' .$i. 'factor'];

        $itemRows [] = $item;
    }

    $product = 0;
    foreach($itemRows as $item){
        $product += $item['count'] * $item['factor'];
    }

    $extraRatePercent = (($product / $RATE) * 100) - 100;

    if($extraRatePercent < 20){
        $extraRate = 0;
    }elseif( $extraRatePercent >= 20 && $extraRatePercent < 40 ){
        $extraRate = 20;
    }elseif($extraRatePercent >= 40 && $extraRatePercent < 60){
        $extraRate = 40;
    }elseif($extraRatePercent >= 60 && $extraRatePercent < 80){
        $extraRate = 60;
    }elseif($extraRatePercent >= 80 && $extraRatePercent < 100){
        $extraRate = 80;
    }elseif($extraRatePercent >= 100 ){
        $extraRate = 100;
    }

    if($bending){

        if($bending['hourlypay'] == 0){
            $bendingPay = ((($bending['item1count'] * $bending['item1cost']) +
                            ($bending['item2count'] * $bending['item2cost']) +
                            ($bending['item3count'] * $bending['item3cost']) +
                            ($bending['item4count'] * $bending['item4cost']) +
                            ($bending['item5count'] * $bending['item5cost']) +
                            ($bending['bonus'])) - ($bending['fine'])) + $bending['extrashift'];
        }else{
            $bendingPay = ((($bending['hours'] * $bending['hourlypay']) + $bending['bonus']) - $bending['fine']) + $bending['extrashift'];
        }
    }

    $totalHours = $bending['hours'];
    $product = number_format($product, 1, ',', ' ');
    $totalPPH = round($bendingPay / $totalHours);

?>