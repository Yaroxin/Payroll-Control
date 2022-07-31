<table id="addHourlyTable" class="DayStatTable singleDayTable">
    <tr class="secondTr">
        <th>Продукция</th>
        <th>Кол-во</th>
    </tr>
    <tr>
        <td>Часы:</td>
        <td class="detailTd"><?php echo $hourlyHours; ?></td>
    </tr>
    <tr>
        <td>Руб/час</td>
        <td class="detailTd"><?php echo $hourlyPPH; ?></td>
    </tr>
    <tr>
        <td>Штраф/Вычет:</td>
        <td class="detailTd"><?php echo $hourlyFine; ?></td>
    </tr>
    <tr>
        <td>Премия:</td>
        <td class="detailTd"><?php echo $hourlyBonus; ?></td>
    </tr>
</table>