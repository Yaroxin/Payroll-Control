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
            $workShift['st'] = $_POST["st"];
            $workShift['stcost'] = $_POST["stcost"];
            $workShift['pv'] = $_POST["pv"];
            $workShift['pvcost'] = $_POST["pvcost"];
            $workShift['pn'] = $_POST["pn"];
            $workShift['pncost'] = $_POST["pncost"];
            $workShift['no'] = $_POST["no"];
            $workShift['nocost'] = $_POST["nocost"];
            $workShift['bonus'] = $_POST["bonus"];
            $workShift['fine'] = $_POST["fine"];
            R::store($workShift);

            $result = 'Запись добавлена!';
         }
    }
    echo json_encode($result);
}else{
    echo json_encode('Error Add');
}

?>
