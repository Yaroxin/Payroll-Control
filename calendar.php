<?php
    require "db.php";    
    if(isset($_SESSION['logged_user'])):
?>
<?php 
    require "userDB.php";
    require "config.php";
    include_once "getStat.php";
    include_once "getCalendar.php";
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
                            <img class="infoBlockIcons hide" src="img\calendar.png" alt="Calendar">
                        </div>
                    </div>                
                    <table class="calendar">
                        <thead>
                            <th class="DayOffth">Su</th>
                            <th>Mo</th>
                            <th>Tu</th>
                            <th>We</th>
                            <th>Th</th>
                            <th>Fr</th>
                            <th class="DayOffth">Sa</th>
                        </thead>
                        <tbody>

                            <?php for($i = 0; $i < count($week); $i++): ?>
                            <tr>
                                <?php for($j = 0; $j < 7; $j++): ?>
                                <?php if(!empty($week[$i][$j])): ?>
                                <?php
                                    if ($workShifts){
                                        $WorkDate = [];
                                        foreach($workShifts as $workShift){
                                            array_push($WorkDate, date("d", strtotime($workShift)));
                                        }
                                        if (in_array($week[$i][$j], $WorkDate)){
                                            $DayClass = 'workDayClass';
                                            $CurDate = date('Y-m-d', strtotime ($_GET['year'].'-'.$_GET['month'].'-'.$week[$i][$j]));
                                            $CurDay = R::getCol("SELECT type FROM `hourly` WHERE date ='" .$CurDate."' UNION SELECT type FROM `bending` WHERE date ='" .$CurDate."'");
                                            if (count($CurDay) > 1){
                                                $DayClass = 'mixDayClass';
                                            }else{
                                                if ($CurDay[0] == 'Ночь'){
                                                    $DayClass = 'workNightClass';
                                                }
                                            }
                                        }else {
                                            if($week[$i][$j] == date('d')){                                                
                                                $DayClass = 'today';
                                            }                                                
                                            if($week[$i][$j] < date('d')){                                                
                                                $DayClass = 'dayOffClass';
                                            }
                                            if($week[$i][$j] > date('d')){                                                
                                                $DayClass = 'noDaysClass';
                                            }
                                        }
                                    }else{
                                        $DayClass = 'noDaysClass';
                                    }
                                ?>

                                <?php if($DayClass == 'dayOffClass' || $DayClass == 'noDaysClass' || $DayClass == 'today'): ?>
                                <td class="<?php echo $DayClass; ?>"><?php echo $week[$i][$j]; ?></td>
                                <?php else: ?>
                                <td class="<?php echo $DayClass; ?>" onclick='location.href="single.php?day=<?php echo $week[$i][$j]; ?>&month=<?php echo $_GET["month"]; ?>&year=<?php echo $_GET["year"]; ?>"'><?php echo $week[$i][$j]; ?></a></td>
                                <?php endif; ?>
                                <?php else: ?>
                                <td></td>
                                <?php endif; ?>
                                <?php endfor; ?>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                    <div class="calStatBlock">
                        <div class="calItemStat">
                            <?php echo count($workShifts); ?>
                            <div class="calItemDesc">Рабочих</div>
                        </div>
                        <div class="calItemStat">
                            <?php echo $dayofmonth; ?>
                            <div class="calItemDesc">Календарных</div>
                        </div>
                        <div class="calItemStat">
                            <?php echo $DayOff; ?>
                            <div class="calItemDesc">Выходных</div>
                        </div>
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