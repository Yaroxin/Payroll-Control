<?php
    require "db.php";    
    if(isset($_SESSION['logged_user'])):
?>
<?php 
    require "userDB.php";
    require "config.php";
    include_once "getStat.php";    
    
    if(!$settings){
        $newSettings = [];
        foreach($defaultSettings as $name => $value){
            $setting = R::dispense('settings');
            $setting['name'] = $name;
            $setting['value'] = $value;
            $newSettings [] = $setting;
        }        
        R::storeAll($newSettings);
    }
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
            <div class="topBoard">
                <div class="homeInfoBlock">
                    <div class="homeInfoBlockLeft">
                        <div class="icons">
                            <a href="home.php"><img class="infoBlockIcons" src="img\home.png" alt="Home" title="Home"></a>
                        </div>
                    </div>
                    <div class="homeInfoBlockCentr">
                        <div class="homeInfoBlockHead">                        
                            <div class="currentMonth">
                                <select class="selectMonth" name="selectMonth" onchange="changeMonth(value);">
                                <option value="<?php echo $selectDate['month']; ?> <?php echo $selectDate['year']; ?>"><?php echo $selectDate['month']; ?> <?php echo $selectDate['year']; ?></option>
                                    <?php foreach($allMonths as $month): ?>                      
                                    <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>                        
                        </div>                
                        <div id="homeAmountPay" class="homeAmountPay">
                            <?php echo $totalPay; ?> &#8381;
                            <div id="paymentDitails" class="paymentDitails hide">
                                <div class="paymentDitailsItem"><?php echo number_format($payPerHours, 0, ',', ' ');?> &#8381;</div>
                                <div class="paymentDitailsItem"><?php echo number_format($bendingBonus, 0, ',', ' ');?> &#8381;</div>
                                <div class="paymentDitailsItem"><?php echo number_format(($payPerHours * ($bonus / 100)), 0, ',', ' ');?> &#8381;</div>
                            </div>
                            <?php if($amountPay <> 0): ?>
                                <?php if($diffPay > 0): ?>
                                    <p class="diffPayPlus"><?php echo $amountPay; ?> &#8381; (+ <?php echo number_format($diffPay, 0, ',', ' '); ?> &#8381;)</p>
                                <?php endif; ?>
                                <?php if($diffPay < 0): ?>
                                    <p class="diffPayMinus"><?php echo $amountPay; ?> &#8381; (- <?php echo number_format(abs($diffPay), 0, ',', ' '); ?> &#8381;)</p>
                                <?php endif; ?>
                                <?php if($diffPay == 0): ?>
                                    <p class="diffPayZero"><?php echo $amountPay; ?> &#8381; (<?php echo number_format(abs($diffPay), 0, ',', ' '); ?> &#8381;)</p>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>                        
                    </div>
                    <div class="homeInfoBlockRight">
                        <div class="icons">
                            <a href="calendar.php?month=<?php echo $selectDate['mon']; ?>&year=<?php echo $selectDate['year']; ?>"><img class="infoBlockIcons" src="img\calendar.png" alt="Calendar" title="Calendar"></a>
                        </div>
                        <div class="icons">
                            <a href="payments.php?month=<?php echo $selectDate['mon']; ?>&year=<?php echo $selectDate['year']; ?>"><img class="infoBlockIcons" src="img\payments.png" alt="Payments" title="Payments"></a>
                        </div>
                    </div>                
                </div>
                <div class="homeInfoBlockStat">
                    <div class="amountHours"><?php echo $totalHours; ?><div class="infoBlockDesc">часов</div></div>
                    <div class="amountPerHour hide"><?php echo $product; ?><div class="infoBlockDesc">комп.</div></div>
                    <div class="amountPerHour"><?php echo $totalPPH; ?><div class="infoBlockDesc">&#8381;/час</div></div>                        
                </div>
            </div>

            <?php if($settings[6]['value'] == '1'): ?>
            <div class="rateBlock">
                <div class="rate">
                    <?php echo $TotalItemsPerHour; ?>
                    <div class="rateDesc">ед./час</div>
                </div>
                <div class="bonus">
                    <?php echo $product; ?>
                    <div class="bonusDesc">едениц</div>
                </div>
                <div class="upRate">
                    <?php echo $TotalMoneyPerItem; ?>
                    <div class="upRateDesc">&#8381;/ед.</div>
                </div>
            </div>
            <?php endif; ?>

            <?php if($settings[5]['value'] == '1'): ?>
            <div class="rateBlock">
                <div class="rate">
                    <?php echo $totalRate; ?>
                    <div class="rateDesc">ед. норма</div>
                </div>
                <div class="bonus">
                    <?php echo $bonus; ?>
                    <div class="bonusDesc">% премия</div>
                </div>
                <div class="upRate">
                    <?php echo $upRate; ?>
                    <div class="upRateDesc">до премии</div>
                </div>
            </div>
            <?php endif; ?>

            <div class="actionBlock">
                <a href="add.php">Добавить</a>
            <?php if($bendingsDates): ?>
                <a href="detail.php">Подробнее</a>
            <?php endif; ?>
            </div>
            <div class="listBlock">                
                <ul>
                    <?php include_once "getHomeStat.php"; ?>
                </ul>
            </div>
        </div>
        </div>
    </div>
    <?php include_once "getScripts.php"; ?>
</body>
</html>

<?php else: header('location: /') ?>
<?php endif; ?>