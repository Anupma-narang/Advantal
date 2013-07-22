<table>
 <?php foreach ($rows as $r): ?>
    <tr>
        <?php foreach ($r as $c): ?>
        <td valign="top"><?php print empty($c)?'*****':$c; ?></td>
        <?php endforeach; ?>
    </tr>
<?php endforeach; ?>
</table>