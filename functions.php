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

    $date = explode("-", $date);

    $bendings = R::getAll( "SELECT * FROM `bending` WHERE MONTH(date) = ".$date['0']." AND YEAR(date) =" .$date['1']);

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

function getProductCount($date){ // $date can be: '01-08-2022' - Day, '08-2022' - Month

    $expDate = explode("-", $date);

    if(count($expDate) == 3){
        $bending = R::findOne('bending', 'date = ?', [$date]);
        if($bending){
            $product =  ($bending['item1count'] * $bending['item1factor']) +
                        ($bending['item2count'] * $bending['item2factor']) +
                        ($bending['item3count'] * $bending['item3factor']) +
                        ($bending['item4count'] * $bending['item4factor']) +
                        ($bending['item5count'] * $bending['item5factor']);

            return $product;
        }else{
            return NULL;
        }

    }elseif(count($expDate) == 2){
        $bendings = R::getAll( "SELECT * FROM `bending` WHERE MONTH(date) = ".$expDate['0']." AND YEAR(date) =" .$expDate['1']);

        if($bendings){
            $product = 0;
            foreach($bendings as $bending){
                $product += ($bending['item1count'] * $bending['item1factor']) +
                            ($bending['item2count'] * $bending['item2factor']) +
                            ($bending['item3count'] * $bending['item3factor']) +
                            ($bending['item4count'] * $bending['item4factor']) +
                            ($bending['item5count'] * $bending['item5factor']);
            }
            return $product;
        }else{
            return NULL;
        }

    }else{
        return NULL;
    }
}

function getHoursCount($date){ // $date can be: '01-08-2022' - Day, '08-2022' - Month
    
    $expDate = explode("-", $date);

    if(count($expDate) == 3){
        $bending = R::findOne('bending', 'date = ?', [$date]);
        if($bending){
            return $bending['hours'];
        }else{
            return NULL;
        }
    }elseif(count($expDate) == 2){
        $bendings = R::getAll( "SELECT * FROM `bending` WHERE MONTH(date) = ".$expDate['0']." AND YEAR(date) =" .$expDate['1']);

        if($bendings){
            $hours = 0;
            foreach($bendings as $bending){
                $hours += $bending['hours'];
            }
            return $hours;
        }else{
            return NULL;
        }
    }else{
        return NULL;
    }
}

function getExtraShiftCount($date){ // $date can be: '01-08-2022' - Day, '08-2022' - Month

    $expDate = explode("-", $date);

    if(count($expDate) == 3){
        $bending = R::findOne('bending', 'date = ?', [$date]);
        if($bending){
            return $bending['extrashift'];
        }else{
            return NULL;
        }
    }elseif(count($expDate) == 2){
        $bendings = R::getAll( "SELECT * FROM `bending` WHERE MONTH(date) = ".$expDate['0']." AND YEAR(date) =" .$expDate['1']);

        if($bendings){
            $extrashift = 0;
            foreach($bendings as $bending){
                $extrashift += $bending['extrashift'];
            }
            return $extrashift;
        }else{
            return NULL;
        }
    }else{
        return NULL;
    }
}