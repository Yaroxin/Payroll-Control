<?php
    require "db.php";    
    if(isset($_SESSION['logged_user'])):
?>
<?php
    require "userDB.php";
    require "config.php";
    include_once "getStat.php";
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
                        <div class="currentMonth">
                            <select class="selectMonth" name="selectMonth" onchange="changeMonth(value);">
                                <option value="<?php echo $selectDate; ?>"><?php echo $selectDate['month']; ?> <?php echo $selectDate['year']; ?></option>
                                <?php foreach($allMonths as $month): ?>                            
                                <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="icons">
                            <a href="calendar.php?month=<?php echo $selectDate['mon']; ?>&year=<?php echo $selectDate['year']; ?>"><img class="infoBlockIcons" src="img\calendar.png" alt="Calendar"></a>
                        </div>
                    </div>                
                    <div class="amountPay"><?php echo $totalPay; ?> &#8381;</div>                
                    <div class="infoBlockStat">
                        <div class="amountHours"><?php echo $totalHours; ?><div class="infoBlockDesc">часов</div></div>
                        <div class="amountPerHour"><?php echo $product; ?><div class="infoBlockDesc">комп.</div></div>
                        <div class="amountPerHour"><?php echo $totalPPH; ?><div class="infoBlockDesc">&#8381;/час</div></div>
                    </div>
                    <?php include_once "modules/bending/detailBending.php"; ?>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "getScripts.php"; ?>
</body>
</html>

<?php else: header('location: /') ?>
<?php endif; ?>