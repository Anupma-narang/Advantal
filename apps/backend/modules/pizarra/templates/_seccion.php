<?php $section_list = Doctrine::getTable('PizarraSectionMapping')->getSectionList($pizarra->getId()); ?>
<?php $pos = 0; ?>
<table>

  <?php foreach ($section_list as $index => $section): ?>
    <tr>
      <td><?php echo $section; ?></td>
    </tr>

  <?php endforeach; ?>
</table>
