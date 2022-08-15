<?php
    require "db.php";   
    if(isset($_SESSION['logged_user'])):
?>
<?php
    require "userDB.php";
    require "config.php";
    $settings = R::findAll('settings');
    $items = R::findAll('item');
    
?>

<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>
<body>
    <div class="wrap">
        <div class="topDecor"></div>
        <?php include "topBar.php"; ?>
        <div class="wrapper">
            <div id="mainWindow" class="mainWindow">            
                <div class="mainInfoBlock">
                    <div class="infoBlockHead">
                        <div class="icons">
                            <a href="home.php"><img class="infoBlockIcons" src="img\home.png" alt="Home"></a>
                        </div>
                        <div class="icons">
                            <a href="calendar.php?month=<?php echo $selectDate['mon']; ?>&year=<?php echo $selectDate['year']; ?>"><img class="infoBlockIcons" src="img\calendar.png" alt="Calendar"></a>
                        </div>
                    </div>
                    <div class="singleSetting">
                        <div id="userSettings" class="singleSettingHead">
                            <div class="settingName">Пользователь</div>
                            <div class="settingArrow">></div>
                        </div>
                        <div id="userSettingsContent" class="singleSettingContent hide">
                            <form class="changePassword" action="" method="POST">
                                <input class="signUpInput" type="text" name="email" placeholder="E-mail">  
                                <input class="signUpInput" type="text" name="login" placeholder="Логин: ivan88">
                                <input class="signUpInput" type="text" name="userName" placeholder="Имя: Иван Иванов">                          
                                <input class="signUpInput" type="password" name="oldPassword"  placeholder="* Старый пароль">
                                <input class="signUpInput" type="password" name="newPassword"  placeholder="* Новый пароль">
                                <input class="signUpInput" type="password" name="confirmNewPassword"  placeholder="* Повтор нового пароля">                                    
                                <input class="signUpButton" type="submit" name="changePasswordButton" value="Сохранить">
                            </form>
                        </div>
                    </div>
                    <form id="settingsForm" action="" method="POST">
                        <div class="itemsBlocks">
                            <?php foreach($items as $item): ?>
                                <div id="itemBlock<?php echo $item['id']; ?>" class="itemBlock">
                                    <div class="itemTitle">
                                        <label class="itemLabel" for="<?php echo $item['name']; ?>Title">Название:</label>
                                        <input class="itemInput itemInputTitle" id="<?php echo $item['name']; ?>Title" type="text" value="<?php echo $item['title']; ?>" name="<?php echo $item['name']; ?>Title" placeholder="Название">
                                    </div>
                                    <div class="itemCost">
                                        <label class="itemLabel" for="<?php echo $item['name']; ?>Cost">Цена:</label>
                                        <input class="itemInput" id="<?php echo $item['name']; ?>Cost" type="text" value="<?php echo $item['cost']; ?>" name="<?php echo $item['name']; ?>Cost" placeholder="Цена">
                                    </div>                            
                                    <div class="itemFactor">
                                        <label class="itemLabel" for="<?php echo $item['name']; ?>Factor">Коэфф.:</label>
                                        <input class="itemInput" id="<?php echo $item['name']; ?>Factor" type="text" value="<?php echo $item['factor']; ?>" name="<?php echo $item['name']; ?>Factor" placeholder="Коэфф.">
                                    </div>                            
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="settingBlock">
                            <div class="settingBlockLeft">
                                <label class="bonusSettingsLabel" for="rate">Норма ед.:</label>
                                <input id="rate" class="settingsInput" type="text" value="<?php echo $settings[1]['value']; ?>" name="rate" placeholder="Норма">
                            </div>
                            <div class="settingBlockRight">
                                <label class="bonusSettingsLabel" for="hourlypay">Цена/час:</label>
                                <input id="hourlypay" class="settingsInput" type="text" value="<?php echo $settings[3]['value']; ?>" name="hourlypay" placeholder="Цена/час">
                            </div>                            
                        </div>

                        <div class="settingBlock">
                            <div class="settingBlockLeft">
                                <label class="bonusSettingsLabel" for="extrashift">Доп. смена:</label>
                                <input id="extrashift" class="settingsInput" type="text" value="<?php echo $settings[4]['value']; ?>" name="extrashift" placeholder="Доп. смена">
                            </div>
                            <div class="settingBlockRight">
                                <label class="bonusSettingsLabel" for="bonus">Премия, %:</label>
                                <input id="bonus" class="settingsInput" type="text" value="<?php echo $settings[2]['value']; ?>" name="bonus" placeholder="Премия %">
                            </div>                            
                        </div>                        
                        
                        <div class="settingBlock">
                            <?php if($settings[5]['value'] == '0'): ?>
                                <input id="bonusBlock" class="extraBlocks" type="checkbox" name="bonusBlock">
                            <?php endif; ?>
                            <?php if($settings[5]['value'] == '1'): ?>
                                <input id="bonusBlock" class="extraBlocks" type="checkbox" checked name="bonusBlock">
                            <?php endif; ?>
                                <label class="extraBlocksLabel" for="bonusBlock">Показывать блок: "Примия"</label>
                                <input id="bonusBlockHidden" type="hidden" name="bonusBlock" value="<?php echo $settings[5]['value']; ?>">
                        </div>

                        <div class="settingBlock">
                            <?php if($settings[6]['value'] == '0'): ?>
                                <input id="productBlock" class="extraBlocks" type="checkbox" name="productBlock">
                            <?php endif; ?>
                            <?php if($settings[6]['value'] == '1'): ?>
                                <input id="productBlock" class="extraBlocks" type="checkbox" checked name="productBlock">
                            <?php endif; ?>                              
                                <label class="extraBlocksLabel" for="productBlock">Показывать блок: "Продукция"</label>
                                <input id="productBlockHidden" type="hidden" name="productBlock" value="<?php echo $settings[6]['value']; ?>">
                        </div>                     

                        <input id="saveSettings" class="saveSetButton" type="submit" name="saveSettings" value="Сохранить">
                    
                    </form>
                    
                </div>                
            </div>
        </div>
    </div>
    <?php include_once "getScripts.php"; ?>
</body>
</html>

<?php else: header('location: /') ?>
<?php endif; ?>