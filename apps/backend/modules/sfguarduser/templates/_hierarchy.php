<?php $heirarchy_list = Doctrine::getTable('Jerarquia')->getHierarchyList();?>
<?php echo $heirarchy_list[$sfguarduser->getProfile()->getHierarchy()];?>
