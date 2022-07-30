<?php

$data = $_POST;
if (isset($data['login'])) {
    $errors = array();
    $user = R::findOne('users', 'email = ?', array($data['email']));

    if(!$user) {
        $user = R::findOne('users', 'login = ?', array($data['email']));
    }

    if($user) {
        if(password_verify($data['password'], $user['password'])) {
            $_SESSION['logged_user'] = $user;
            if($user['status'] != 'demo'){
                header('location: /home.php');
            }else{
                header('location: /home.php?month=1&year=2021');
            }
           
        }else {
            $errors[] = 'Incorecct Password';
        }
    }else {
        $errors[] = 'User does not exist.';
    }
}

?>
