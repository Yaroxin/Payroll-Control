<?php 
    foreach($workShifts as $workShift){
        $dayHours = 0;
        $dayHourlyHours = 0;
        $dayBendingHours = 0;
        $dayBendingSumm = 0;
        $stCount = 0;
        $pvCount = 0;
        $pnCount = 0;
        $noCount = 0;
        $item5Count = 0;
        $product = 0;
        $itemID = 0;
        $workTitles = [];
        $workTypes = [];
        $workTT = [];
        
        foreach($bendings as $bending){
            if($bending['date'] == $workShift){
                $dayBendingHours = $dayBendingHours + $bending['hours'];

                $hourlyPay = $bending['hourlypay'];

                $product += ($bending['item1count'] * $bending['item1factor']) +
                            ($bending['item2count'] * $bending['item2factor']) +
                            ($bending['item3count'] * $bending['item3factor']) +
                            ($bending['item4count'] * $bending['item4factor']) +
                            ($bending['item5count'] * $bending['item5factor']);

                if($hourlyPay == 0){
                    $dayBendingSumm = 
                    ((($bending['item1count'] * $bending['item1cost']) +
                    ($bending['item2count'] * $bending['item2cost']) +
                    ($bending['item3count'] * $bending['item3cost']) +
                    ($bending['item4count'] * $bending['item4cost']) +
                    ($bending['item5count'] * $bending['item5cost']) +
                    ($bending['bonus'])) - ($bending['fine'])) + $bending['extrashift'];
                }else{
                    $dayBendingSumm = ((($dayBendingHours * $hourlyPay) + $bending['bonus']) - $bending['fine']) + $bending['extrashift'];
                }                

                $stCount = $bending['item1count'];
                $pvCount = $bending['item2count'];
                $pnCount = $bending['item3count'];
                $noCount = $bending['item4count'];
                $item5Count = $bending['item5count'];
                $bonus = $bending['bonus'];
                $fine = $bending['fine'];
                $itemType = $bending['hourlypay'];
                $extraShift = $bending['extrashift'];

                array_push($workTitles, $bending['title']);
                array_push($workTypes, $bending['type']);
            }
        }

        $workTT = array_combine($workTitles, $workTypes);

        $dayHours = $dayBendingHours;
        $dayPaySumm = number_format($dayBendingSumm, 0, ',', ' ');
        $dayPayPerHour = number_format($dayBendingSumm / $dayHours, 0, ',', ' ');
        $product = number_format($product, 1, ',', ' ');
        $itemID = date('dmy', strtotime($workShift));
        

        include "listBlock.php";
    }
?>