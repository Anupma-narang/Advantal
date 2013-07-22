<?php $state = Doctrine::getTable('States')->find($gift_redemption->getStatesId());?>
<?php echo $state->getName();?>
