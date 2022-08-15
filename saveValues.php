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
            $val =  $_POST["item1count"] + $_POST["item2count"] + $_POST["item3count"] + $_POST["item4count"] + $_POST["item5count"];

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

                $workday['date'] = $_POST["changeDate"];
                $workday['hours'] = $_POST["Hours"];
                $workday['item1count'] = $_POST["item1count"];
                $workday['item2count'] = $_POST["item2count"];
                $workday['item3count'] = $_POST["item3count"];
                $workday['item4count'] = $_POST["item4count"];
                $workday['item5count'] = $_POST["item5count"];
                $workday['item1cost'] = $_POST["item1cost"];
                $workday['item2cost'] = $_POST["item2cost"];
                $workday['item3cost'] = $_POST["item3cost"];
                $workday['item4cost'] = $_POST["item4cost"];
                $workday['item5cost'] = $_POST["item5cost"];
                $workday['item1factor'] = $_POST["item1factor"];
                $workday['item2factor'] = $_POST["item2factor"];
                $workday['item3factor'] = $_POST["item3factor"];
                $workday['item4factor'] = $_POST["item4factor"];
                $workday['item5factor'] = $_POST["item5factor"];
                $workday['bonus'] = $_POST["bonus"];
                $workday['fine'] = $_POST["fine"];
                $workday['note'] = $_POST["addNote"];
                R::store($workday);
                $result = ('Запись сохранена.');  
            }else{
                R::trash($workday);
                $result = ('Запись удалена.');
            }     
        }
        
    }   

} else{
    $result = ('Нечего менять!');
}

echo json_encode($result);

?>
