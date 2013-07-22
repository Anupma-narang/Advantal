<?php $state = Doctrine::getTable('States')->find($contratanos->getStatesId());?>
<?php echo $state->getName();?>
