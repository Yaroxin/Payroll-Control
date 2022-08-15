<?php
    require "db.php";
    require "userDB.php";
    require "config.php";   
    
    $settings = R::findAll('settings');
    $items = R::findAll('item');

    if($items){
        $changedItems = [];
        foreach ($items as $item){
            $item['title'] = $_POST[$item['name'] . 'Title'];
            $item['cost'] = $_POST[$item['name'] . 'Cost'];
            $item['factor'] = $_POST[$item['name'] . 'Factor'];
            $changedItems [] = $item;        
        }    
        R::storeAll($changedItems);
        $result = ('Success');
    }else{
        $result = ('Error');
    }

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
