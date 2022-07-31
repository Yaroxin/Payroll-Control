<form id="addHourlyPayForm" action="" method="POST">
    <table id="addHourlyTable" class="DayStatTable">
        <tr>
            <th><input id="InputDateHourlyPay" class="InputDate" type="date" name="Date" value="<?php echo date("Y-m-d")?>" required></th>
            <th>
                <select class="SelectTime" name="WorkTime">
                    <option value="День">День</option>
                    <option value="Ночь">Ночь</option>
                </select>
            </th>
        </tr>
        <tr class="secondTr">
            <th>Продукция</th>
            <th>Кол-во</th>
        </tr>
        <tr>
            <td>Часы:</td>
            <td><input id="hourlyPayHours" inputmode="decimal" class="WorkDayListItem  HoursInput forZero" type="text" maxlength="4" name="Hours" value="0" required onchange="summCalc('hourly'); activateAddButton('hourlyPay');"></td>
        </tr>
        <tr>
            <td>Руб/час</td>
            <td><input id="rubPerHour" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" name="RubPerHour" maxlength="4" value="0" required onchange="summCalc('hourly'); activateAddButton('hourlyPay');"></td>
        </tr>
        <tr>
            <td>Штраф/Вычет:</td>
            <td><input id="fineHourly" class="WorkDayListItem forZero" type="text" name="fine" maxlength="4" value="0" onchange="summCalc('hourly');"></td>
        </tr>
        <tr>
            <td>Премия:</td>
            <td><input id="bonusHourly" pattern="[0-9]*" class="WorkDayListItem forZero" type="text" maxlength="4" name="bonus" value="0" onchange="summCalc('hourly');"></td>
        </tr>
        <tr>
            <td><input id="paySummHourly" class="paySumm" type="text" name="paySumm" value="Итого: 0 &#8381;"></td>
            <td class="addButtonCell"><input id="AddhourlyPayDay" class="AddButton notActiveBtn" type="submit" name="AddHourlyPayDay" value="Добавить" onclick="addWorkDay('#addHourlyPayForm');" disabled></td>
        </tr>

        <input pattern="[0-9]*" type="hidden" name="WorkType" value="Hourly">
    </table>
</form>