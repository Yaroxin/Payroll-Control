<?php
    //$dayofmonth = date('t'); // Вычисляем число дней в текущем месяце
    $dayofmonth = cal_days_in_month(CAL_GREGORIAN, $_GET['month'], $_GET['year']);
    $day_count = 1;  // Счётчик для дней месяца

    if ($_GET['month'] == date('m')){
        $DayOff = date('d') - count($workShifts);
    }else{
        $DayOff = $dayofmonth - count($workShifts);
    }

  $num = 0;  // 1. Первая неделя
    for($i = 0; $i < 7; $i++) {
        // Вычисляем номер дня недели для числа
        $dayofweek = date('w', mktime(0, 0, 0, $_GET['month'], $day_count, $_GET['year']));

        // Приводим числа к формату 1 - понедельник, ..., 6 - суббота
        //$dayofweek = $dayofweek - 1;
        if($dayofweek == -1){
            $dayofweek = 6;
        }

        if($dayofweek == $i){
            // Если дни недели совпадают, заполняем массив $week числами месяца
            $week[$num][$i] = $day_count;
            $day_count++;

        }else {
            $week[$num][$i] = "";
        }

    }

    while(true) {  // 2. Последующие недели месяца
        $num++;
        for($i = 0; $i < 7; $i++) {
            $week[$num][$i] = $day_count;
            $day_count++;
            // Если достигли конца месяца - выходим из цикла
            if($day_count > $dayofmonth) break;
        }
        // Если достигли конца месяца - выходим из цикла
        if($day_count > $dayofmonth) break;

    }

?>