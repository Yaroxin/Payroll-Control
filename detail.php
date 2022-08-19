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
                            <div class="homeAmountPay">
                                <?php echo $totalPay; ?> &#8381;
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







                <div class="brieflyItemInfo extraShift">        
                    <div class="itemType">
                        <div class="workTime">
                            <img src="<?php echo $itemTypeImg; ?>" alt="icon">                  
                        </div>
                        <div class="workType">
                            <img src="<?php echo $itemDescImg; ?>" alt="icon">                  
                        </div>
                    </div>
                    <div class="itemDate">
                        <?php echo date( "d.m.Y", strtotime($workShift)) ;?>  
                        <div class="itemDesc">            
                            <?php echo $title; ?>
                        </div>
                    </div>
                    <div class="itemHours">
                        <?php echo $dayHours;?>
                        <div class="itemDesc">Часов</div>
                    </div>
                    <div class="itemPay">
                    <?php echo $product;?>
                        <div class="itemDesc">Едениц</div>
                    </div>
                    <div class="itemPerHour">
                        <?php echo $dayPayPerHour ;?>
                        <div class="itemDesc">&#8381;/час</div>
                    </div>
                    <div class="itemPay">
                        <?php echo $dayPaySumm ;?>
                        <div class="itemDesc">Рублей</div>
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