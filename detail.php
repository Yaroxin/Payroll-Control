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
                            <tr class="detailTableHead"><td colspan="5"><?php echo $selectDate['month']; ?> <?php echo $selectDate['year']; ?></td></tr>
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
                            <tr class="detailLink" id="<?php echo $bending['date'] ?>">
                                <td><?php echo date('d.m.y', strtotime($bending['date'])); ?></td>
                                <td><?php echo $bending['hours'] ?></td>
                                <td><?php echo number_format(getProductCount($bending['date']), 1, ',', ' '); ?></td>
                                <td><?php echo number_format(getExtraShiftCount($bending['date']), 0, ',', ' '); ?></td>
                                <td><?php echo number_format(getDailyPayment($bending['date']), 0, ',', ' '); ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr><td colspan="5"></td></tr>
                        </tbody>
                        <tfoot>
                            <tr class="detailTableFooter">
                                <td>Итого</td>
                                <td><?php echo number_format(getHoursCount(date('m-Y', strtotime($bending['date']))), 0, ',', ' '); ?></td>
                                <td><?php echo number_format(getProductCount(date('m-Y', strtotime($bending['date']))), 0, ',', ' '); ?></td>
                                <td><?php echo number_format(getExtraShiftCount(date('m-Y', strtotime($bending['date']))), 0, ',', ' '); ?></td>
                                <td><?php echo number_format(getMonthlyPayment(date('m-Y', strtotime($bending['date']))), 0, ',', ' '); ?></td>
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