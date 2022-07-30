<?php
    require "db.php";
    require "userDB.php";
    require "config.php";   
    
    $settings = R::findAll('settings');

    if($settings){
        $newSettings = [];
        foreach($settings as $setting){
            foreach (array_keys($_POST) as $key){
                if($setting['name'] == $key){
                    $setting['value'] = $_POST[$key];
                }
                $newSettings [] = $setting;
            }
        }
        R::storeAll($newSettings);
        $result = ('Success');

    }else{        
        $newSettings = [];
        foreach($defaultSettings as $name => $value){
            $setting = R::dispense('settings');
            $setting['name'] = $name;
            $setting['value'] = $value;

            $newSettings [] = $setting;
        }
        
        R::storeAll($newSettings);
        $result = ('Success');
    }
    
    echo json_encode($result);

?>
