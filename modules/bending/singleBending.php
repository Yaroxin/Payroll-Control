<form id="addBendingForm" action="" method="POST">
    <table id="addBendingTable" class="DayStatTable singleDayTable">
        <tr class="secondTr">
            <th>Продукция</th>
            <th>Кол-во</th>
            <th>Цена</th>
        </tr>
        <tr>
            <td>Часы:</td>
            <td><input id="bendingHours" inputmode="decimal" class="WorkDayListItem HoursInput" type="text" name="Hours" value="<?php echo $bendingHours; ?>" maxlength="4" disabled></td>
            <td>-</td>
        </tr>
        <tr>
            <td><?php echo $settings[1]['value']; ?>:</td>
            <td><input id="stCount" pattern="[0-9]*" class="WorkDayListItem" type="text" name="st" value="<?php echo $stCount; ?>" maxlength="3" disabled></td>
            <td><input id="stCost" pattern="[0-9]*" class="WorkDayListItem <?php echo $stCostStyle; ?>" type="text" name="stcost" value="<?php echo $stCost; ?>" maxlength="2" disabled></td>
        </tr>
        <tr>
            <td><?php echo $settings[2]['value']; ?>:</td>
            <td><input id="pvCount" pattern="[0-9]*" class="WorkDayListItem" type="text" name="pv" value="<?php echo $pvCount; ?>" maxlength="3" disabled></td>
            <td><input id="pvCost" pattern="[0-9]*" class="WorkDayListItem <?php echo $pvCostStyle; ?>" type="text" name="pvcost" value="<?php echo $pvCost; ?>" maxlength="2" disabled></td>
        </tr>
        <tr>
            <td><?php echo $settings[3]['value']; ?>:</td>
            <td><input id="pnCount" pattern="[0-9]*" class="WorkDayListItem" type="text" name="pn" value="<?php echo $pnCount; ?>" maxlength="3" disabled></td>
            <td><input id="pnCost" pattern="[0-9]*" class="WorkDayListItem <?php echo $pnCostStyle; ?>" type="text" name="pncost" value="<?php echo $pnCost; ?>" maxlength="2" disabled></td>
        </tr>
        <tr>
            <td><?php echo $settings[4]['value']; ?>:</td>
            <td><input id="noCount" pattern="[0-9]*" class="WorkDayListItem" type="text" name="no" value="<?php echo $noCount; ?>" maxlength="3" disabled ></td>
            <td><input id="noCost" pattern="[0-9]*" class="WorkDayListItem <?php echo $noCostStyle; ?>" type="text" name="nocost" value="<?php echo $noCost; ?>" maxlength="2" disabled></td>
        </tr>
        <tr>
            <td>Штраф/Вычет:</td>
            <td><input id="fine" pattern="[0-9]*" class="WorkDayListItem" type="text" name="fine" value="<?php echo $bendingFine; ?>" maxlength="4" disabled>
            </td>
            <td>-</td>
        </tr>
        <tr>
            <td>Премия:</td>
            <td><input id="Rub" pattern="[0-9]*" class="WorkDayListItem" type="text" name="bonus" value="<?php echo $bendingBonus; ?>" maxlength="4" disabled></td>
            <td>-</td>
        </tr>
        <tr>
        <tr>
            <td colspan="3"></td>
        </tr> 
            <td>Почасовая оплата</td>
            <td>
                <?php if ($bending['hourlypay'] == 0): ?>
                    <input type="checkbox" id="hourlyPayCheck" name="hourlyPayCheck" disabled onchange="clearInput('hourlyPay');">                    
                <?php else:?>
                    <input type="checkbox" id="hourlyPayCheck" name="hourlyPayCheck" checked disabled onchange="clearInput('hourlyPay');">
                <?php endif;?>
            </td>
            <td><input id="hourlyPayValue" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="hourlyPayValue" value="<?php echo $bending['hourlypay']; ?>" maxlength="4" disabled></td>
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
            <td><input id="extraShiftValue" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="extraShiftValue" value="<?php echo $bending['extrashift']; ?>" maxlength="4" disabled></td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr> 
        <tr>        
            <td class="addButtonCell"><input id="editBendingDay" class="AddButton" type="button" name="editBendingDay" value="Изменить" onclick="editValues('addBendingTable');"></td>
            <td class="addButtonCell" colspan="3"><input id="saveBendingValues" class="AddButton notActiveBtn" type="submit" name="saveBendingValues" value="Сохранить" onclick="saveValues('#addBendingForm', 'addBendingTable');" disabled></td>
        </tr>        
    </table>
    <input type="hidden" name="workDayId" value="<?php echo $bending['id']; ?>">
    <input type="hidden" name="workDayTable" value="bending">
</form>