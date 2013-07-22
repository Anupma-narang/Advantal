<?php $heirarchy_records = Doctrine::getTable('Jerarquia')->getHierarchyList();?>
<?php echo $heirarchy_records[$reward_log->getHierarchy()];?>
