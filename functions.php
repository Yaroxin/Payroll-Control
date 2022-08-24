<?php

function getDailyPayment($date){

    $bending = R::findOne('bending', 'date = ?', [$date]);

    if($bending){    

        if($bending['hourlypay'] != 0){
            $dailyPayment = (((($bending['hours'] * $bending['hourlypay']) + $bending['bonus']) - $bending['fine'])) + $bending['extrashift'];
        }else{
            $dailyPayment = (($bending['item1count'] * $bending['item1cost']) +
                            ($bending['item2count'] * $bending['item2cost']) +
                            ($bending['item3count'] * $bending['item3cost']) +
                            ($bending['item4count'] * $bending['item4cost']) +
                            ($bending['item5count'] * $bending['item5cost']) +
                            ($bending['bonus']) + ($bending['extrashift'])) - $bending['fine'];
        }
        
        return $dailyPayment;
    }else{
        return NULL;
    }
}

function getMonthlyPayment($date){  //$date format: 'm-Y'( Август 2022 = '08-2022' )

    $selectDate = explode("-", $date);

    $bendings = R::getAll( "SELECT * FROM `bending` WHERE MONTH(date) = ".$selectDate['0']." AND YEAR(date) =" .$selectDate['1']);

    if($bendings){ 
        $monthlyPayment = 0;  
        foreach($bendings as $bending){
            if($bending['hourlypay'] != 0){
                $monthlyPayment += (((($bending['hours'] * $bending['hourlypay']) + $bending['bonus']) - $bending['fine'])) + $bending['extrashift'];
            }else{
                $monthlyPayment += (($bending['item1count'] * $bending['item1cost']) +
                                    ($bending['item2count'] * $bending['item2cost']) +
                                    ($bending['item3count'] * $bending['item3cost']) +
                                    ($bending['item4count'] * $bending['item4cost']) +
                                    ($bending['item5count'] * $bending['item5cost']) +
                                    ($bending['bonus']) + ($bending['extrashift'])) - $bending['fine'];
            }
        }
        return $monthlyPayment;
    }else{
        return NULL;
    }
}

function getProductCount($date){

    $bending = R::findOne('bending', 'date = ?', [$date]);

    if($bending){
        $productCount =  ($bending['item1count'] * $bending['item1factor']) +
                        ($bending['item2count'] * $bending['item2factor']) +
                        ($bending['item3count'] * $bending['item3factor']) +
                        ($bending['item4count'] * $bending['item4factor']) +
                        ($bending['item5count'] * $bending['item5factor']);        
        
        return $productCount;

    }else{
        return NULL;
    }
}