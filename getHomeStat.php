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
        $itemID = 0;
        $workTitles = [];
        $workTypes = [];
        $workTT = [];
        
        foreach($bendings as $bending){
            if($bending['date'] == $workShift){
                $dayBendingHours = $dayBendingHours + $bending['hours'];

                $hourlyPay = $bending['hourlypay'];

                if($hourlyPay == 0){
                    $dayBendingSumm = 
                    ((($bending['st'] * $bending['stcost']) +
                    ($bending['pv'] * $bending['pvcost']) +
                    ($bending['pn'] * $bending['pncost']) +
                    ($bending['no'] * $bending['nocost']) +
                    ($bending['bonus'])) - ($bending['fine'])) + $bending['extrashift'];
                }else{
                    $dayBendingSumm = ((($dayBendingHours * $hourlyPay) + $bending['bonus']) - $bending['fine']) + $bending['extrashift'];
                }                

                $stCount = $bending['st'];
                $pvCount = $bending['pv'];
                $pnCount = $bending['pn'];
                $noCount = $bending['no'];
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
        $itemID = date('dmy', strtotime($workShift));
        

        include "listBlock.php";
    }
?>