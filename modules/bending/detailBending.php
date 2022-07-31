<table id="addBendingTable" class="DayStatTable detailTable">
    <tr class="secondTr">
        <th>Продукция</th>
        <th>Кол-во</th>
    </tr>
    <tr>
        <td>Часы:</td>
        <td class="detailTd"><?php echo $bendingHours; ?></td>
    </tr>
    <tr>
        <td><?php echo $settings[1]['value']; ?>:</td>
        <td class="detailTd"><?php echo $stCount; ?></td>
    </tr>
    <tr>
        <td><?php echo $settings[2]['value']; ?>:</td>
        <td class="detailTd"><?php echo $pvCount; ?></td>
    </tr>
    <tr>
        <td><?php echo $settings[3]['value']; ?>:</td>
        <td class="detailTd"><?php echo $pnCount; ?></td>
    </tr>
    <tr>
        <td><?php echo $settings[4]['value']; ?>:</td>
        <td class="detailTd"><?php echo $noCount; ?></td>
    </tr>
    <tr>
        <td>Штраф/Вычет:</td>
        <td class="detailTd"><?php echo $bendingFine; ?></td>
    </tr>
    <tr>
        <td>Премия:</td>
        <td class="detailTd"><?php echo $bendingBonus; ?></td>
    </tr>
</table>