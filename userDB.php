<?php
    $userDB = [
        'name' => $_SESSION['logged_user'] -> dbname,
        'host' => '127.0.0.1',
        'login' => 'yaroxin',
        'password' => 'Ya35792817',
    ];

    R::addDatabase($userDB['name'], sprintf('mysql:host='.$userDB['host'].';dbname='.$userDB['name']), $userDB['login'], $userDB['password']);
    R::selectDatabase($userDB['name']);
    if ( !R::testConnection() ) {        
        exit ('Нет соединения с базой данных');
    }
?>