<?php $heirarchy_records = Doctrine::getTable('Jerarquia')->getHierarchyList();?>

<?php echo substr($heirarchy_records[$gift->getHierarchy()], 0, 20);?>
