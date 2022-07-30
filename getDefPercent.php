<?php 

if($WorkDay['stoyki'] > 0){
    $stDefPercent = round((($WorkDay['stdefect'] / $WorkDay['stoyki']) * 100), 1);
}else{
    $stDefPercent = 0;
}

if($WorkDay['perekladinav'] > 0){
    $pvDefPercent = round((($WorkDay['pvdefect'] / $WorkDay['perekladinav']) * 100), 1);
}else{
    $pvDefPercent = 0;
}

if($WorkDay['perekladinan'] > 0){
    $pnDefPercent = round((($WorkDay['pndefect'] / $WorkDay['perekladinan']) * 100), 1);
}else{
    $pnDefPercent = 0;
}

if($WorkDay['obnal'] > 0){
    $onDefPercent = round((($WorkDay['ondefect'] / $WorkDay['obnal']) * 100), 1);
}else{
    $onDefPercent = 0;
}

if($WorkDay['nalok'] > 0){
    $noDefPercent = round((($WorkDay['nodefect'] / $WorkDay['nalok']) * 100), 1);
}else{
    $noDefPercent = 0;
}

?>