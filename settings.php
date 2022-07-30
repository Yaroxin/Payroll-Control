<?php
    require "db.php";   
    if(isset($_SESSION['logged_user'])):
?>
<?php
    require "userDB.php";
    require "config.php";
    $settings = R::findAll('settings');
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
                        <label class="bonusSettingsLabel" for="rate">Item #1:</label>
                        <input id="Item1Name" class="settingsInput" type="text" value="<?php echo $settings[1]['value']; ?>" name="itemName1" placeholder="Item #1">
                        <label class="bonusSettingsLabel" for="rate">Item #2:</label>
                        <input id="Item2Name" class="settingsInput" type="text" value="<?php echo $settings[2]['value']; ?>" name="itemName2" placeholder="Item #2">
                        <label class="bonusSettingsLabel" for="rate">Item #3:</label>
                        <input id="Item3Name" class="settingsInput" type="text" value="<?php echo $settings[3]['value']; ?>" name="itemName3" placeholder="Item #3">
                        <label class="bonusSettingsLabel" for="rate">Item #4:</label>
                        <input id="Item4Name" class="settingsInput" type="text" value="<?php echo $settings[4]['value']; ?>" name="itemName4" placeholder="Item #4">                        
                        <label class="bonusSettingsLabel" for="rate"><?php echo $settings[1]['value']; ?> цена:</label>
                        <input id="Item1Cost" class="settingsInput" type="text" value="<?php echo $settings[5]['value']; ?>" name="itemCost1" placeholder="Item #1 Cost">
                        <label class="bonusSettingsLabel" for="rate"><?php echo $settings[2]['value']; ?> цена:</label>
                        <input id="Item2Cost" class="settingsInput" type="text" value="<?php echo $settings[6]['value']; ?>" name="itemCost2" placeholder="Item #2 Cost">
                        <label class="bonusSettingsLabel" for="rate"><?php echo $settings[3]['value']; ?> цена:</label>
                        <input id="Item3Cost" class="settingsInput" type="text" value="<?php echo $settings[7]['value']; ?>" name="itemCost3" placeholder="Item #3 Cost">
                        <label class="bonusSettingsLabel" for="rate"><?php echo $settings[4]['value']; ?> цена:</label>
                        <input id="Item4Cost" class="settingsInput" type="text" value="<?php echo $settings[8]['value']; ?>" name="itemCost4" placeholder="Item #4 Cost">
                        <label class="bonusSettingsLabel" for="rate">Норма ед.:</label>
                        <input id="rate" class="settingsInput" type="text" value="<?php echo $settings[9]['value']; ?>" name="rate" placeholder="Норма">
                        <label class="bonusSettingsLabel" for="bonus">Премия, %:</label>
                        <input id="bonus" class="settingsInput" type="text" value="<?php echo $settings[10]['value']; ?>" name="bonus" placeholder="Премия %">
                        <label class="bonusSettingsLabel" for="hourlypay">Цена/час:</label>
                        <input id="hourlypay" class="settingsInput" type="text" value="<?php echo $settings[11]['value']; ?>" name="hourlyPay" placeholder="Цена/час">
                        <label class="bonusSettingsLabel" for="extrashift">Доп. смена:</label>
                        <input id="extrashift" class="settingsInput" type="text" value="<?php echo $settings[12]['value']; ?>" name="extrashift" placeholder="Доп. смена">

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