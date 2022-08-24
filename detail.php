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
                <div class="topBoard">
                    <div class="homeInfoBlock">
                        <div class="homeInfoBlockLeft">
                            <div class="icons">
                                <a href="home.php"><img class="infoBlockIcons" src="img\home.png" alt="Home" title="Home"></a>
                            </div>
                            <div class="icons">
                                <a href="#"><img class="infoBlockIcons" src="img\share.png" alt="share" title="share"></a>
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
                    <table class="detailTable">
                        <thead>
                            <tr class="detailTableHead"><td colspan="5">Август 2022 (<?php echo $selectDate['mon']; ?>)</td></tr>
                            <tr class="detailTableHead">
                                <td>Дата</td>
                                <td>Часы</td>
                                <td>Ед.</td>
                                <td>Доп. см.</td>
                                <td>Сумма</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td colspan="5"></td></tr>
                            <?php foreach($bendings as $bending): ?>
                            <tr>
                                <td><?php echo date('d.m.Y', strtotime($bending['date'])); ?></td>
                                <td><?php echo $bending['hours'] ?></td>
                                <td><?php echo number_format(getProductCount($bending['date']), 1, ',', ' '); ?></td>
                                <td><?php echo $bending['extrashift'] ?></td>
                                <td><?php echo number_format(getDailyPayment($bending['date']), 0, ',', ' '); ?> &#8381;</td>
                            </tr>
                            <?php endforeach; ?>
                            <tr><td colspan="5"></td></tr>
                        </tbody>
                        <tfoot>
                            <tr class="detailTableFooter">
                                <td>Итого</td>
                                <td>4 156</td>
                                <td>1 987</td>
                                <td>-</td>
                                <td><?php echo number_format(getMonthlyPayment('08-2022'), 0, ',', ' '); ?> &#8381;</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "getScripts.php"; ?>
</body>
</html>

<?php else: header('location: /') ?>
<?php endif; ?>