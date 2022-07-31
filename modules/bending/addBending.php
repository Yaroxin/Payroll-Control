<?php
    $settings = R::findAll('settings');
?>

<form id="addBendingForm" action="" method="post">
    <table id="addBendingTable" class="DayStatTable">
        <tr>
            <th colspan="2"><input id="inputDateBending" class="InputDate" type="date" name="Date" value="<?php echo date("Y-m-d")?>" required></th>
            <th colspan="2">
                <select class="SelectTime" name="WorkTime">
                    <option value="День">День</option>
                    <option value="Ночь">Ночь</option>
                </select>
            </th>
        </tr>
        <tr class="secondTr">
            <th>Продукция</th>
            <th>Кол-во</th>
            <th>Цена</th>
        </tr>
        <tr>
            <td>Часы:</td>
            <td><input id="bendingHours" inputmode="decimal" class="WorkDayListItem HoursInput forZero" type="text" name="Hours" value="0" maxlength="4" required onchange="summCalc('bending'); activateAddButton('bending');"></td>
            <td>-</td>
        </tr>
        <tr>
            <td><?php echo $settings[1]['value']; ?>:</td>
            <td><input id="stCount" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="st" value="0" maxlength="3" required onchange="summCalc('bending'); activateAddButton('bending');"></td>
            <?php foreach($settings as $cost): ?>
                <?php if($cost['name'] == 'itemCost1'): ?>
                    <td><input id="stCost" pattern="[0-9]*" class="WorkDayListItem" type="text" name="stcost" value="<?php echo $cost['value']; ?>" maxlength="2" required></td>
                <?php endif; ?>      
            <?php endforeach; ?>
        </tr>
        <tr>
            <td><?php echo $settings[2]['value']; ?>:</td>
            <td><input id="pvCount" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="pv" value="0" maxlength="3" required onchange="summCalc('bending'); activateAddButton('bending');"></td>
            <?php foreach($settings as $cost): ?>
                <?php if($cost['name'] == 'itemCost2'): ?>
                    <td><input id="pvCost" pattern="[0-9]*" class="WorkDayListItem" type="text" name="pvcost" value="<?php echo $cost['value']; ?>" maxlength="2" required></td>
                <?php endif; ?>      
            <?php endforeach; ?>
        </tr>
        <tr>
            <td><?php echo $settings[3]['value']; ?>:</td>
            <td><input id="pnCount" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="pn" value="0" maxlength="3" required onchange="summCalc('bending'); activateAddButton('bending');"></td>
            <?php foreach($settings as $cost): ?>
                <?php if($cost['name'] == 'itemCost3'): ?>
                    <td><input id="pnCost" pattern="[0-9]*" class="WorkDayListItem" type="text" name="pncost" value="<?php echo $cost['value']; ?>" maxlength="2" required></td>
                <?php endif; ?>      
            <?php endforeach; ?>
        </tr>
        <tr>
            <td><?php echo $settings[4]['value']; ?>:</td>
            <td><input id="noCount" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="no" value="0" maxlength="3" required onchange="summCalc('bending'); activateAddButton('bending');"></td>
            <?php foreach($settings as $cost): ?>
                <?php if($cost['name'] == 'itemCost4'): ?>
                    <td><input id="noCost" pattern="[0-9]*" class="WorkDayListItem" type="text" name="nocost" value="<?php echo $cost['value']; ?>" maxlength="2" required></td>
                <?php endif; ?>      
            <?php endforeach; ?>
        </tr>
        <tr>
            <td>Штраф/Вычет:</td>
            <td><input id="fine" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="fine" value="0" maxlength="4" onchange="summCalc('bending');">
            </td>
            <td>-</td>
        </tr>
        <tr>
            <td>Премия:</td>
            <td><input id="Rub" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="bonus" value="0" maxlength="4" onchange="summCalc('bending');"></td>
            <td>-</td>
        </tr>    
        <tr>
            <td colspan="3"></td>
        </tr>    
        <tr>
            <td>Почасовая оплата</td>
            <td>
                <input type="checkbox" id="hourlyPayCheck" name="hourlyPayCheck" checked onchange="summCalc('bending');">
            </td>
            <td><input id="hourlyPayValue" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="hourlyPayValue" value="<?php echo $settings[11]['value']; ?>" maxlength="4"></td>
        </tr>    
        <tr>
            <td>Доп. смена</td>
            <td>
                <input type="checkbox" id="extraShiftCheck" name="extraShiftCheck" onchange="summCalc('bending');">
            </td>
            <td><input id="extraShiftValue" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="extraShiftValue" value="<?php echo $settings[12]['value']; ?>" maxlength="4"></td>
        </tr> 
        <tr>
            <td colspan="3"></td>
        </tr>    
        <tr>
            <td><input id="paySummBending" class="paySumm" type="text" name="paySumm" value="Итого: 0 &#8381;"></td>
            <td class="addButtonCell" colspan="3"><input id="AddbendingDay" class="AddButton notActiveBtn" type="submit" name="AddBendingDay" value="Добавить" onclick="addWorkDay('#addBendingForm');" disabled></td>
        </tr>
        <input pattern="[0-9]*" type="hidden" name="WorkType" value="Bending">
    </table>
</form>