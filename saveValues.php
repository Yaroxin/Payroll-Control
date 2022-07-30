<?php
if (!empty($_POST["workDayId"]) && !empty($_POST["workDayTable"])) {
    require "db.php";
    require "userDB.php";

    $workday = R::load($_POST["workDayTable"], $_POST["workDayId"]);    
   
    if (!$workday){
       $result = 'noData';
    } else {
        if($_POST["workDayTable"] == 'hourly'){
            if(($_POST["Hours"] != 0) && ($_POST["PayPerHour"] != 0)){
                $workday['hours'] = $_POST["Hours"];
                $workday['payperhour'] = $_POST["PayPerHour"];
                $workday['bonus'] = $_POST["bonus"];
                $workday['fine'] = $_POST["fine"];
                R::store($workday);
                $result = ('Запись сохранена.');
            }else{
                R::trash($workday);
                $result = ('Запись удалена.');
            }            
        }

        if($_POST["workDayTable"] == 'bending'){
            $val =  $_POST["st"] + $_POST["pv"] + $_POST["pn"] + $_POST["on"] + $_POST["no"];

            if($_POST["Hours"] != 0 && $val != 0){

                if($_POST["extraShiftCheck"] == 'on'){
                    $workday['extrashift'] = $_POST["extraShiftValue"];
                }else{
                    $workday['extrashift'] = 0;
                }

                if($_POST["hourlyPayCheck"] == 'on'){
                    $workday['hourlypay'] = $_POST["hourlyPayValue"];
                }else{
                    $workday['hourlypay'] = 0;
                }

                $workday['hours'] = $_POST["Hours"];
                $workday['st'] = $_POST["st"];
                $workday['stcost'] = $_POST["stcost"];
                $workday['pv'] = $_POST["pv"];
                $workday['pvcost'] = $_POST["pvcost"];
                $workday['pn'] = $_POST["pn"];
                $workday['pncost'] = $_POST["pncost"];
                $workday['no'] = $_POST["no"];
                $workday['nocost'] = $_POST["nocost"];
                $workday['bonus'] = $_POST["bonus"];
                $workday['fine'] = $_POST["fine"]; 
                R::store($workday);
                $result = ('Запись сохранена.');    
            }else{
                R::trash($workday);
                $result = ('Запись удалена.');
            }     
        }
        
    }   

} else{
    $result = ('Нечего менять! Добавте запись.');
}

echo json_encode($result);

?>
