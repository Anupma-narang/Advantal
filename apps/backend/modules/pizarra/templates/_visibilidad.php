<?php $hierarch = array( 0 => 'Público');?>
<?php $hierarch = array_merge($hierarch, Doctrine::getTable('Jerarquia')->getHierarchyList()) ;?>
<?php echo $hierarch[$pizarra->getVisibilidad()];?>
