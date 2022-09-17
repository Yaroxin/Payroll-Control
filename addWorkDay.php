<?php
if (isset($_POST["WorkType"]) && isset($_POST["Date"]) ) {
    require "db.php";
    require "userDB.php";

    if($_POST["WorkType"] == 'Bending'){
        $workShift = R::findOne('bending', 'date = ?', [$_POST['Date']]);

        if ($workShift){
            $result = 'Запись уже есть!';
         } else {
            $workShift = R::dispense('bending');
            $workShift['date'] = $_POST["Date"];
            $workShift['type'] = $_POST["WorkTime"];

            if($_POST["extraShiftCheck"] == 'on'){
                $workShift['extrashift'] = $_POST["extraShiftValue"];
            }else{
                $workShift['extrashift'] = 0; 
            }

            if($_POST["hourlyPayCheck"] == 'on'){
                $workShift['hourlypay'] = $_POST["hourlyPayValue"];
            }else{
                $workShift['hourlypay'] = 0;
            }
            
            $workShift['title'] = 'Гиб(Рамы)';            
            $workShift['hours'] = $_POST["Hours"];
            $workShift['item1count'] = $_POST["item1count"];
            $workShift['item2count'] = $_POST["item2count"];
            $workShift['item3count'] = $_POST["item3count"];
            $workShift['item4count'] = $_POST["item4count"];
            $workShift['item5count'] = $_POST["item5count"];
            $workShift['item1cost'] = $_POST["item1cost"];
            $workShift['item2cost'] = $_POST["item2cost"];
            $workShift['item3cost'] = $_POST["item3cost"];
            $workShift['item4cost'] = $_POST["item4cost"];
            $workShift['item5cost'] = $_POST["item5cost"];
            $workShift['item1factor'] = $_POST["item1factor"];
            $workShift['item2factor'] = $_POST["item2factor"];
            $workShift['item3factor'] = $_POST["item3factor"];
            $workShift['item4factor'] = $_POST["item4factor"];
            $workShift['item5factor'] = $_POST["item5factor"];
            $workShift['bonus'] = $_POST["bonus"];
            $workShift['fine'] = $_POST["fine"];
            $workShift['note'] =  $_POST["addNote"];
            R::store($workShift);

            $result = 'Запись добавлена!';
         }
    }
    echo json_encode($result);
}else{
    echo json_encode('Error Add');
}

?>
