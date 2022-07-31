<form id="addHourlyForm" action="" method="POST">
    <table id="addHourlyTable" class="DayStatTable singleDayTable">
        <tr class="secondTr">
            <th>Продукция</th>
            <th>Кол-во</th>
        </tr>
        <tr>
            <td>Часы:</td>
            <td><input id="hourlyPayHours" inputmode="decimal" class="WorkDayListItem  HoursInput" type="text" name="Hours" value="<?php echo $hourlyHours; ?>" disabled required></td>
        </tr>
        <tr>
            <td>Руб/час</td>
            <td><input id="rubPerHour" pattern="[0-9]*" class="WorkDayListItem" type="text" name="PayPerHour" value="<?php echo $hourlyPPH; ?>" disabled required></td>
        </tr>
        <tr>
            <td>Штраф/Вычет:</td>
            <td><input id="fineHourly" class="WorkDayListItem" type="text" name="fine" value="<?php echo $hourlyFine; ?>" disabled></td>
        </tr>
        <tr>
            <td>Премия:</td>
            <td><input id="bonusHourly" pattern="[0-9]*" class="WorkDayListItem" type="text" name="bonus" value="<?php echo $hourlyBonus; ?>" maxlength="4" disabled></td>
        </tr>
        <tr>
            <td class="addButtonCell"><input id="editHourlyDay" class="AddButton" type="button" name="editHourlyDay" value="Изменить" onclick="editValues('addHourlyTable');"></td>
            <td class="addButtonCell"><input id="saveHourlyValues" class="AddButton notActiveBtn" type="submit" name="saveHourlyValues" value="Сохранить" onclick="saveValues('#addHourlyForm', 'addHourlyTable');" disabled></td>
        </tr>               
    </table>
    <input type="hidden" name="workDayId" value="<?php echo $hourly['id']; ?>">
    <input type="hidden" name="workDayTable" value="hourly">
</form>