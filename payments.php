<?php
    require "db.php";    
    if(isset($_SESSION['logged_user'])):
?>
<?php
    require "userDB.php";
    require "config.php";
    include_once "getStat.php";
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
                <div id="payoutInfo" class="mainInfoBlock">
                    <div class="infoBlockHead">
                        <div class="icons">
                            <a href="home.php"><img class="infoBlockIcons" src="img\home.png" alt="Home"></a>
                        </div>
                        <div class="currentMonth">
                            <select id="selectMonth" class="selectMonth" name="selectMonth" onchange="changeMonth(value);">
                                <option value="<?php echo $selectDate['month']; ?> <?php echo $selectDate['year']; ?>"><?php echo $selectDate['month']; ?> <?php echo $selectDate['year']; ?></option>
                                <?php foreach($allMonths as $month): ?>                            
                                <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="icons">
                            <a href="calendar.php?month=<?php echo $selectDate['mon']; ?>&year=<?php echo $selectDate['year']; ?>"><img class="infoBlockIcons" src="img\calendar.png" alt="Calendar"></a>
                        </div>
                    </div>                
                    <div id="amountPay" class="amountPay mt-20">
                        <?php echo $amountPay; ?> &#8381;
                        <?php if($amountPay <> 0): ?>
                        <?php if($diffPay > 0): ?>
                            <p class="diffPayPlus">+ <?php echo number_format($diffPay, 0, ',', ' '); ?> &#8381;</p>
                        <?php endif; ?>
                        <?php if($diffPay < 0): ?>
                            <p class="diffPayMinus">- <?php echo number_format(abs($diffPay), 0, ',', ' '); ?> &#8381;</p>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>                
                    <div class="infoBlockStat">
                        <div id="amountPrepaid" class="amountHours prepaid"><?php echo $prepaid; ?>&#8381;<div class="infoBlockDesc">??????????</div></div>
                        <div id="amountSalary" class="amountPerHour salary"><?php echo $salary; ?>&#8381;<div class="infoBlockDesc">????????????????</div></div>
                        <div id="amountSalary" class="amountPerHour salary"><?php echo $dopBonus; ?>&#8381;<div class="infoBlockDesc">??????. ????????????</div></div>
                    </div>
                </div>
                <div id="addPayoutBlock" class="mainInfoBlock hide">
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
                    <form id="addPayoutForm" action="" method="POST">
                        <div class="addPayoutInputs">
                            <input id="prepaid" type="text" name="prepaid" inputmode="decimal" placeholder="??????????" >
                            <input id="salary" type="text" name="salary" inputmode="decimal" placeholder="????????????????" >
                            <input id="bonus" type="text" name="bonus" inputmode="decimal" placeholder="??????. ????????????" >
                            <input type="hidden" name="date" value="<?php echo $selectDate['month']; ?> <?php echo $selectDate['year']; ?>">
                            <input type="hidden" id="type" name="type" value="">
                        </div>
                        <input type="submit" id="savePayout" class="mainButton" value="??????????????????">                        
                    </form>
                </div>
                <div class="actionBlock">
                    <?php if($payData != 0): ?>
                        <button id="addPayout" class="mainButton notActiveBtn" disabled>????????????????</button>
                        <button id="changePayout" class="mainButton">????????????????</button>
                        <button id="clearPayout" class="mainButton">????????????????</button>
                    <?php else: ?>
                        <button id="addPayout" class="mainButton">????????????????</button>
                        <button id="changePayout" class="mainButton notActiveBtn" disabled>????????????????</button>
                        <button id="clearPayout" class="mainButton notActiveBtn" disabled>????????????????</button>
                    <?php endif; ?>                    
                </div>
            </div>
        </div>
    </div>
    <?php include_once "getScripts.php"; ?>
</body>
</html>

<?php else: header('location: /') ?>
<?php endif; ?>