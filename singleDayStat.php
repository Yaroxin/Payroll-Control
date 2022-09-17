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

    if(((($product / $RATE) - 1) * 100) < 20){
        $extraRate = 0;
    }else if(((($product / $RATE) - 1) * 100) >= 20 && ((($product / $RATE) - 1) * 100) < 40){
        $extraRate = 20;
    }else if(((($product / $RATE) - 1) * 100) >= 40 && ((($product / $RATE) - 1) * 100) < 60){
        $extraRate = 40;
    }else if(((($product / $RATE) - 1) * 100) >= 60 && ((($product / $RATE) - 1) * 100) < 80){
        $extraRate = 60;
    }else if(((($product / $RATE) - 1) * 100) >= 80 && ((($product / $RATE) - 1) * 100) < 100){
        $extraRate = 80;
    }else if(((($product / $RATE) - 1) * 100) >= 100 ){
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