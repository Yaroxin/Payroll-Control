<?php
    if ($_SESSION['logged_user'] -> status == 'dev'){
        $data = $_POST;
        if (isset($data['signUpButton'])) {
            $errors = array();
            if(trim($data['email']) == '') {
                $errors[] = 'Введите E-mail';
            }
            if($data['password'] == '') {
                $errors[] = 'Введите пароль';
            }
            if($data['confirmPassword'] != $data['password']) {
                $errors[] = 'Пароли не совпадают';
            }
            if(R::count('users', "email = ?", array($data['email'])) > 0) {
                $errors[] = 'Такой E-mail уже используется';
            }

            if(R::count('users', "login = ?", array($data['login'])) > 0) {
                $errors[] = 'Такой логин уже используется';
            }

            $usersCount = R::count('users');
            if($usersCount < 10){
                $userDbName = 'udb01700'.$usersCount;
            }
            if($usersCount >= 10){
                $userDbName = 'udb0170'.$usersCount;
            }
            if($usersCount >= 100){
                $userDbName = 'udb017'.$usersCount;
            }

            if(R::count('users', "dbname = ?", array($userDbName)) > 0) {
                $errors[] = 'База данных занята';
            }

            if(empty($errors)) {
                $message = [];
                $symbols = array('@', '.');
                $UserTable = (str_replace($symbols, '', $data['email']));
                $defaultModules = R::findAll('modules');

                if($data['login'] == ''){
                    $data['login'] = NULL;
                }

                if($data['userName'] == ''){
                    $data['userName'] = NULL;
                }

                R::exec("DROP DATABASE IF EXISTS " .$userDbName);
                R::exec("CREATE DATABASE IF NOT EXISTS " .$userDbName);                
            
                R::addDatabase($userDbName, sprintf('mysql:host=127.0.0.1;dbname='.$userDbName), 'root', 'root');
                R::selectDatabase($userDbName);
                if ( !R::testConnection() ) {
                    $errors[] = 'Нет соединения с базой данных';
                }else{
                    $modules = [];
                    foreach($defaultModules as $defaultModule){
                        $module = R::dispense('modules');
                        $module['name'] = $defaultModule['name'];
                        $module['title'] = $defaultModule['title'];
                        $module['status'] = $defaultModule['status'];
                        if($defaultModule['name'] == 'hourlyModule'){
                            $module['setup'] = 'true';
                        }else{
                            $module['setup'] = 'false';
                        }
                        $modules [] = $module;
                    }
                    
                    $newSettings = [];
                    foreach($defaultSettings as $name => $cost){
                        $setting = R::dispense('settings');
                        $setting['name'] = $name;
                        $setting['value'] = $cost;
                        if($name == 'stcost'){$setting['title'] = 'Стойки';}
                        if($name == 'pvcost'){$setting['title'] = 'Перек. Верх.';}
                        if($name == 'pncost'){$setting['title'] = 'Перек. Низ.';}
                        if($name == 'oncost'){$setting['title'] = 'Объем. нал.';}
                        if($name == 'nocost'){$setting['title'] = 'Наличние окна';}
            
                        $newSettings [] = $setting;
                    }
                    
                    R::storeAll($modules);
                    R::storeAll($newSettings);
                    $message[] = 'Пользователь добавлен';                    
                }
                
                if(empty($errors)) {
                    R::selectDatabase('default');
                    $user = R::xdispense('users');
                    $user['email'] = $data['email'];
                    $user['login'] = $data['login'];
                    $user['name'] = $data['userName'];
                    $user['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    $user['status'] = 'user';
                    $user['dbname'] = $userDbName;
                    R::store($user);
                    
                    $message[] = 'Пользователь добавлен';
                }                
            }
        }
    }
?>