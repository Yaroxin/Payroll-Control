<form id="addBendingForm" action="" method="POST">
    <table id="addBendingTable" class="DayStatTable singleDayTable">
        <tr class="secondTr">
            <th>Продукция</th>
            <th>Кол-во</th>
            <th>K.</th>
            <th>Цена</th>
        </tr>
        <tr>
            <td>Часы:</td>
            <td colspan="3"><input id="bendingHours" inputmode="decimal" class="WorkDayListItem HoursInput" type="text" name="Hours" value="<?php echo $totalHours; ?>" maxlength="2" disabled></td>
        </tr>

    <?php foreach($itemRows as $item): ?>
        <tr>
            <td><?php echo $item['title']; ?>:</td>
            <td><input id="<?php echo $item['name']; ?>count" pattern="[0-9]{1,3}" class="WorkDayListItem" type="text" name="<?php echo $item['name']; ?>count" value="<?php echo $item['count']; ?>" inputmode="decimal" maxlength="3" disabled></td>
            <td><input id="<?php echo $item['name']; ?>factor" pattern="\d+(\.\d{1,2})?" class="WorkDayListItem <?php echo $stCostStyle; ?>" type="text" name="<?php echo $item['name']; ?>factor" value="<?php echo $item['factor']; ?>" inputmode="decimal" maxlength="4" disabled></td>
            <td><input id="<?php echo $item['name']; ?>cost" pattern="[0-9]{1,3}" class="WorkDayListItem <?php echo $stCostStyle; ?>" type="text" name="<?php echo $item['name']; ?>cost" value="<?php echo $item['cost']; ?>" inputmode="decimal" maxlength="3" disabled></td>
        </tr>
    <?php endforeach; ?>

        <tr>
            <td>Штраф/Вычет:</td>
            <td colspan="3"><input id="fine" pattern="[0-9]*" class="WorkDayListItem" type="text" name="fine" value="<?php echo $bending['fine']; ?>" inputmode="decimal" maxlength="4" disabled></td>
        </tr>
        <tr>
            <td>Премия:</td>
            <td colspan="3"><input id="Rub" pattern="[0-9]*" class="WorkDayListItem" type="text" name="bonus" value="<?php echo $bending['bonus']; ?>" inputmode="decimal" maxlength="4" disabled></td>
        </tr>
        <tr>
        <tr>
            <td colspan="3"></td>
        </tr> 
            <td>Почасовая</td>
            <td>
                <?php if ($bending['hourlypay'] == 0): ?>
                    <input type="checkbox" id="hourlyPayCheck" name="hourlyPayCheck" disabled onchange="clearInput('hourlyPay');">                    
                <?php else:?>
                    <input type="checkbox" id="hourlyPayCheck" name="hourlyPayCheck" checked disabled onchange="clearInput('hourlyPay');">
                <?php endif;?>
            </td>
            <td colspan="2"><input id="hourlyPayValue" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="hourlyPayValue" value="<?php echo $bending['hourlypay']; ?>" inputmode="decimal" maxlength="4" disabled></td>
            <input type="hidden" id="hourlyPaySet" name="hourlyPaySet" value="<?php echo $settings[3]['value']; ?>">
        </tr> 
        <tr>
            <td>Доп. смена</td>
            <td>
                <?php if ($bending['extrashift'] == 0): ?>
                    <input type="checkbox" id="extraShiftCheck" name="extraShiftCheck" disabled onchange="clearInput('extraShift');">
                <?php else:?>
                    <input type="checkbox" id="extraShiftCheck" name="extraShiftCheck" checked disabled onchange="clearInput('extraShift');">
                <?php endif;?>
            </td>
            <td colspan="2"><input id="extraShiftValue" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="extraShiftValue" value="<?php echo $bending['extrashift']; ?>" inputmode="decimal" maxlength="4" disabled></td>
            <input type="hidden" id="extraShiftSet" name="extraShiftSet" value="<?php echo $settings[4]['value']; ?>">
        </tr>
        <tr>
            <td colspan="4"></td>
        </tr> 
        <tr id="changeDateTr" class="hide">
            <td>Дата</td>
            <td colspan="3"><input id="changeDate" class="InputDate changeInputDate" type="date" name="changeDate" disabled value="<?php echo $bending['date']?>"></td>
        </tr> 
        <tr>
            <td colspan="4">                
                <textarea id="addNote" class="addNote" name="addNote" rows="4" maxlength="300" wrap="hard"><?php echo $bending['note']; ?></textarea>
            </td>
        </tr>         
        <tr>
            <td colspan="4"></td>
        </tr> 
        <tr>        
            <td class="addButtonCell" colspan="2"><input id="editBendingDay" class="AddButton" type="button" name="editBendingDay" value="Изменить" onclick="editValues('addBendingTable');"></td>
            <td class="addButtonCell" colspan="2"><input id="saveBendingValues" class="AddButton notActiveBtn" type="submit" name="saveBendingValues" value="Сохранить" onclick="saveValues('#addBendingForm', 'addBendingTable');" disabled></td>
        </tr>        
    </table>
    <input type="hidden" name="workDayId" value="<?php echo $bending['id']; ?>">
    <input type="hidden" name="workDayTable" value="bending">
</form>