<?php
    require "db.php";
    require "config.php";
    if(isset($_SESSION['logged_user'])):
?>
<?php require "signUp.php"; ?>

<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>
<body>
    <div class="wrap">
        <div class="topDecor"></div>
        <?php include "topBar.php"; ?>
        <div id="mainWindow" class="mainWindow">            
            <div class="mainInfoBlock">
                <div class="infoBlockHead">
                    <div class="icons">
                        <a href="home.php"><img class="infoBlockIcons" src="img\home.png" alt="Home"></a>
                    </div>
                </div>
                <div class="signUpBlock">    
                    <div class="signUpArea">
                        <?php if(!empty($errors)): ?>
                        <div class="errorsBar"><?php echo array_shift($errors); ?></div>
                        <?php endif; ?>
                        <?php if(!empty($message)): ?>
                        <div class="messageBar"><?php echo array_shift($message); ?></div>
                        <?php endif; ?>
                        <form class="signUpForm" action="" method="POST">
                            <input class="signUpInput" type="text" name="email" required placeholder="* E-mail">                            
                            <input class="signUpInput" type="password" name="password" required placeholder="* Пароль">
                            <input class="signUpInput" type="password" name="confirmPassword" required placeholder="* Повтор Пароля">
                            <input class="signUpInput" type="text" name="login" placeholder="Логин: ivan88">
                            <input class="signUpInput" type="text" name="userName" placeholder="Имя: Иван Иванов">
                            <input class="signUpButton" type="submit" name="signUpButton" value="Регистрация">
                        </form>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    <?php include_once "getScripts.php"; ?>
</body>
</html>

<?php else: header('location: /') ?>
<?php endif; ?>


