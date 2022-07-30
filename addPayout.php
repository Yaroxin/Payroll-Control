<?php
require "db.php";
require "userDB.php"; 

if ( isset($_POST["date"]) && isset($_POST["prepaid"]) && isset($_POST["salary"]) && isset($_POST["bonus"]) ) {          

    if($_POST["prepaid"] == ''){
        $prepaid = 0;
    }else{
        $prepaid = $_POST["prepaid"];
    }

    if($_POST["salary"] == ''){
        $salary = 0;
    }else{
        $salary = $_POST["salary"];
    }

    if($_POST["bonus"] == ''){
        $bonus = 0;
    }else{
        $bonus = $_POST["bonus"];
    }
    
    if($_POST["type"] == 'addPayout'){
        $payment = R::findOne('payments', 'date = ?', [$_POST['date']]);
        if(!$payment){
            if(($prepaid + $salary + $bonus) != 0){
                $payment = R::dispense('payments');
                $payment['date'] = $_POST["date"];
                $payment['prepaid'] = number_format($prepaid, 2, '.', '');
                $payment['salary'] = number_format($salary, 2, '.', '');
                $payment['bonus'] = number_format($bonus, 2, '.', '');
                R::store($payment);
                $result = "OK";
            }else{
                $result = "Введите данный";
            }

        }else{
            $result = "Запись уже есть! Можно изменить.";
        }
    }
    
    if($_POST["type"] == 'changePayout'){
        $paymentID = (R::findOne('payments', 'date = ?', [$_POST['date']]))['id'];
        if($paymentID){
            if(($prepaid + $salary + $bonus) != 0){
                $payment = R::load('payments', $paymentID);
                $payment['date'] = $_POST["date"];
                if($prepaid != 0){
                    $payment['prepaid'] = number_format($prepaid, 2, '.', '');
                }
                if($salary != 0){
                    $payment['salary'] = number_format($salary, 2, '.', '');
                }            
                if($bonus != 0){
                    $payment['bonus'] = number_format($bonus, 2, '.', '');
                }            
                R::store($payment);            
                $result = "OK";
            }else{
                $result = "Введите данный";
            }
        }else{
            $result = "Нечего менять! Добавте запись.";
        }        
    }

}else{
    $result = "There is no DATA!";

    if($_POST["type"] == 'clearPayout'){        
        $paymentID = (R::findOne('payments', 'date = ?', [$_POST['date']]))['id'];
        if($paymentID){
            $payment = R::load('payments', $paymentID);
            $payment['prepaid'] = number_format(0, 2, '.', '');
            $payment['salary'] = number_format(0, 2, '.', '');
            $payment['bonus'] = number_format(0, 2, '.', '');
            R::store($payment);
            $result = "OK";
        }else{
            $result = "Нет записи!"; 
        }
        
    }
}

echo json_encode($result);

?>