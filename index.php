<?php
    require "db.php";
    require "config.php";
    if(!isset($_SESSION['logged_user'])):
?>
<?php require "login.php"; ?>

<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>
<body>  
    <div class="wrap">
        <div class="topDecor"></div>
        <div class="topBar">
            <div class="userName"><?php echo $APP_NAME .' '. $VERSION; ?></div>    
        </div>       
        <div id="mainWindow" class="mainWindow">            
            <div class="mainInfoBlock">                
                <div class="loginBlock">    
                    <div class="loginArea">
                        <?php if(!empty($errors)): ?>
                        <div class="errorsBar"><?php echo array_shift($errors); ?></div>
                        <?php endif; ?>
                        <form class="LoginForm" action="" method="POST">
                            <input class="LoginInput" type="text" name="email" required placeholder="E-mail or Login">
                            <input class="LoginInput" type="password" name="password" required placeholder="Password">
                            <input class="LoginButton" type="submit" name="login" value="Войти">
                        </form>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</body>
</html>
<?php else: header('location: /home.php') ?>
<?php endif; ?>