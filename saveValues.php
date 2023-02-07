<?php
if (!empty($_POST["workDayId"]) && !empty($_POST["workDayTable"])) {
    require "db.php";
    require "userDB.php";

    $workday = R::load($_POST["workDayTable"], $_POST["workDayId"]);    
   
    if (!$workday){
       $result = 'noData';
    } else {
        if($_POST["workDayTable"] == 'bending'){
            
            if($_POST["Hours"] != 0){

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

                if($_POST["useInCalc"] == 'on'){
                    $workday['useincalc'] = 1;
                }else{
                    $workday['useincalc'] = 0;
                }

                $workday['title'] = 'Гиб(Рамы)';
                $workday['date'] = $_POST["Date"];
                $workday['type'] = $_POST["WorkTime"];
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
                $result = ($_POST["Date"] . ':' . 'save'); 
            }else{
                R::trash($workday);
                $result = ($_POST["Date"] . ':' . 'delete');
            }     
        }
        
    }   

} else{
    $result = ('Нечего менять!');
}

echo json_encode($result);

?>
