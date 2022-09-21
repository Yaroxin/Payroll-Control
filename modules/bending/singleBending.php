<form id="addBendingForm" action="" method="post">
    <table id="addBendingTable" class="DayStatTable">
        <tr>
            <th colspan="2"><input id="inputDateBending" class="InputDate" type="date" name="Date" value="<?php echo $bending['date']; ?>" required disabled></th>
            <th colspan="2">
                <select class="SelectTime" name="WorkTime" id="SelectTime" disabled>
                    <?php if($bending['type'] == 'День'): ?>
                    <option value="День" selected>День</option>
                    <option value="Ночь">Ночь</option>
                    <?php elseif($bending['type'] == 'Ночь'): ?>
                    <option value="День">День</option>
                    <option value="Ночь" selected>Ночь</option>
                    <?php endif; ?>
                </select>
            </th>
        </tr>
        <tr class="secondTr">
            <th>Продукция</th>
            <th>Кол-во</th>
            <th>K.</th>
            <?php if($bending['hourlypay'] == 0): ?>
            <th class="costCol">Цена</th>
            <?php else: ?>
            <th class="costCol hide">Цена</th>
            <?php endif; ?>
        </tr>
        <tr>
            <td>Часы:</td>
            <td colspan="3"><input id="bendingHours" inputmode="decimal" class="WorkDayListItem HoursInput forZero" type="text" name="Hours" value="<?php echo $totalHours; ?>" maxlength="2" disabled onchange="reCalculate(this, <?php echo $settings[1]['value'];?>);"></td>
        </tr>

    <?php foreach($itemRows as $item): ?>
        <tr>
            <td><?php echo $item['title']; ?>:</td>
            <td class="colStile"><input id="<?php echo $item['name']; ?>count" pattern="[0-9]{1,3}" class="WorkDayListItem forZero" type="text" name="<?php echo $item['name']; ?>count" value="<?php echo $item['count']; ?>" inputmode="decimal" maxlength="3" disabled onchange="reCalculate(this, <?php echo $settings[1]['value'];?>);"></td>
            <td class="colStile"><input id="<?php echo $item['name']; ?>factor" pattern="\d+(\.\d{1,2})?" class="WorkDayListItem" type="text" name="<?php echo $item['name']; ?>factor" value="<?php echo $item['factor']; ?>" inputmode="decimal" maxlength="4" disabled onchange="reCalculate(this, <?php echo $settings[1]['value'];?>);"></td>
            
            <?php if($bending['hourlypay'] == 0): ?>
            <td class="colStile costCol"><input id="<?php echo $item['name']; ?>cost" class="WorkDayListItem costInput" type="text" name="<?php echo $item['name']; ?>cost" value="<?php echo $item['cost']; ?>" inputmode="decimal" maxlength="4" disabled onchange="reCalculate(this, <?php echo $settings[1]['value'];?>);"></td>
            <?php else: ?>
            <td class="colStile costCol hide"><input id="<?php echo $item['name']; ?>cost" class="WorkDayListItem costInput" type="text" name="<?php echo $item['name']; ?>cost" value="<?php echo $item['cost']; ?>" inputmode="decimal" maxlength="4" disabled onchange="reCalculate(this, <?php echo $settings[1]['value'];?>);"></td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>

        <tr>
            <td>Штраф/Вычет:</td>
            <td colspan="3"><input id="fine" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="fine" value="<?php echo $bending['fine']; ?>" inputmode="decimal" maxlength="4" disabled onchange="reCalculate(this, <?php echo $settings[1]['value'];?>);"></td>
        </tr>
        <tr>
            <td>Премия:</td>
            <td colspan="3"><input id="Rub" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="bonus" value="<?php echo ($bending['bonus'] + $bending['extrabonus']); ?>" inputmode="decimal" maxlength="4" disabled onchange="reCalculate(this, <?php echo $settings[1]['value'];?>);"></td>
        </tr>    
        <tr>
            <td colspan="4"></td>
        </tr>    
        <tr>
            <td>Почасовая</td>
            <td>
                <?php if ($bending['hourlypay'] == 0): ?>
                    <input type="checkbox" id="hourlyPayCheck" name="hourlyPayCheck" disabled onchange="clearInput('hourlyPay'); hideCostCol(this); reCalculate(this, <?php echo $settings[1]['value'];?>);">                    
                <?php else:?>
                    <input type="checkbox" id="hourlyPayCheck" name="hourlyPayCheck" checked disabled onchange="clearInput('hourlyPay'); hideCostCol(this); reCalculate(this, <?php echo $settings[1]['value'];?>);">
                <?php endif;?>
            </td>
            <td colspan="2"><input id="hourlyPayValue" inputmode="decimal" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="hourlyPayValue" value="<?php echo $settings[3]['value']; ?>" maxlength="4" disabled onchange="reCalculate(this, <?php echo $settings[1]['value'];?>);"></td>
            <input type="hidden" id="hourlyPaySet" name="hourlyPaySet" value="<?php echo $settings[3]['value']; ?>">
        </tr>    
        <tr>
            <td>Доп. смена</td>            
                <?php if ($bending['extrashift'] == 0): ?>
                    <td><input type="checkbox" id="extraShiftCheck" name="extraShiftCheck" disabled onchange="clearInput('extraShift'); reCalculate(this, <?php echo $settings[1]['value'];?>);"></td>
                    <td colspan="2"><input id="extraShiftValue" inputmode="decimal" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="extraShiftValue" value="0" maxlength="4" disabled onchange="reCalculate(this, <?php echo $settings[1]['value'];?>);"></td>
                <?php else:?>
                    <td><input type="checkbox" id="extraShiftCheck" name="extraShiftCheck" checked disabled onchange="clearInput('extraShift'); reCalculate(this, <?php echo $settings[1]['value'];?>);"></td>
                    <td colspan="2"><input id="extraShiftValue" inputmode="decimal" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="extraShiftValue" value="<?php echo $settings[4]['value']; ?>" maxlength="4" disabled onchange="reCalculate(this, <?php echo $settings[1]['value'];?>);"></td>
                <?php endif;?>            
            <input type="hidden" id="extraShiftSet" name="extraShiftSet" value="<?php echo $settings[4]['value']; ?>">
        </tr> 
        <tr>
            <td colspan="4"></td>
        </tr>  
        <tr>
            <td colspan="4">
                <textarea id="addNote" class="addNote" name="addNote" rows="4" maxlength="300" wrap="hard" disabled><?php echo $bending['note']; ?></textarea>
            </td>
        </tr>
    </table>

    <div class="buttonBlock">
        <input id="editBendingDay" class="AddButton" type="button" name="editBendingDay" value="Изменить" onclick="editValues('addBendingTable');">
        <input id="saveBendingValues" class="AddButton notActiveBtn" type="submit" name="saveBendingValues" value="Сохранить" onclick="saveValues('#addBendingForm', 'addBendingTable');" disabled>
    </div>

    <input type="hidden" name="workDayId" value="<?php echo $bending['id']; ?>">
    <input type="hidden" name="workDayTable" value="bending">
</form>