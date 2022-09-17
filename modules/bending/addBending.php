<?php
    $settings = R::findAll('settings');
    $items = R::findAll('item');
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
            <th>K.</th>
            <th class="costCol hide">Цена</th>            
        </tr>
        <tr>
            <td>Часы:</td>
            <td colspan="3"><input id="bendingHours" inputmode="decimal" class="WorkDayListItem HoursInput forZero" type="text" name="Hours" value="0" maxlength="2" required onchange="summCalc('bending', '<?php echo $settings[1]['value']; ?>'); activateAddButton('bending');"></td>
        </tr>

    <?php foreach($items as $item): ?>
        <tr>
            <td><?php echo $item['title']; ?>:</td>
            <td class="colStile"><input id="<?php echo $item['name']; ?>count" pattern="[0-9]{1,3}" class="WorkDayListItem forZero" type="text" name="<?php echo $item['name']; ?>count" value="0" inputmode="decimal" maxlength="3" required onchange="summCalc('bending', '<?php echo $settings[1]['value']; ?>'); activateAddButton('bending');"></td>
            <td class="colStile"><input id="<?php echo $item['name']; ?>factor" pattern="\d+(\.\d{1,2})?" class="WorkDayListItem" type="text" name="<?php echo $item['name']; ?>factor" value="<?php echo $item['factor']; ?>" inputmode="decimal" maxlength="4" required></td>
            <td class="colStile costCol hide"><input id="<?php echo $item['name']; ?>cost" pattern="[0-9]{1,3}" class="WorkDayListItem costInput" type="text" name="<?php echo $item['name']; ?>cost" value="<?php echo $item['cost']; ?>" inputmode="decimal" maxlength="3" required></td>
        </tr>
    <?php endforeach; ?>

        <tr>
            <td>Штраф/Вычет:</td>
            <td colspan="3"><input id="fine" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="fine" value="0" inputmode="decimal" maxlength="4" onchange="summCalc('bending', '<?php echo $settings[1]['value']; ?>');"></td>
        </tr>
        <tr>
            <td>Премия:</td>
            <td colspan="3"><input id="Rub" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="bonus" value="0" inputmode="decimal" maxlength="4" onchange="summCalc('bending', '<?php echo $settings[1]['value']; ?>');"></td>
        </tr>    
        <tr>
            <td colspan="4"></td>
        </tr>    
        <tr>
            <td>Почасовая</td>
            <td>
                <input type="checkbox" id="addHourlyPayCheck" name="hourlyPayCheck" checked onchange="summCalc('bending', '<?php echo $settings[1]['value']; ?>'); hideCostCol(this);">
            </td>
            <td colspan="2"><input id="hourlyPayValue" inputmode="decimal" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="hourlyPayValue" value="<?php echo $settings[3]['value']; ?>" maxlength="4"></td>
        </tr>    
        <tr>
            <td>Доп. смена</td>
            <td>
                <input type="checkbox" id="addExtraShiftCheck" name="extraShiftCheck" onchange="summCalc('bending', '<?php echo $settings[1]['value']; ?>');">
            </td>
            <td colspan="2"><input id="extraShiftValue" inputmode="decimal" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="extraShiftValue" value="<?php echo $settings[4]['value']; ?>" maxlength="4"></td>
        </tr> 
        <tr>
            <td colspan="4"></td>
        </tr>  
        <tr>
            <td colspan="4">
                <textarea id="addNote" class="addNote" name="addNote" rows="4" maxlength="300" wrap="hard" placeholder="Примечание"></textarea>
            </td>
        </tr>  
        <tr>
            <td colspan="4"></td>
        </tr> 
        <tr>
            <td><input id="paySummBending" class="paySumm" type="text" name="paySumm" value="Итого: 0 &#8381;"></td>
            <td class="addButtonCell" colspan="3"><input id="AddbendingDay" class="AddButton notActiveBtn" type="submit" name="AddBendingDay" value="Добавить" onclick="addWorkDay('#addBendingForm');" disabled></td>
        </tr>
        <input type="hidden" name="WorkType" value="Bending">
    </table>
</form>