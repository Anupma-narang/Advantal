<?php $user = Doctrine::getTable('sfGuardUser')->find($gift_redemption->getUser());?>
<?php echo  substr($user->getUsername(), 0, 25);?>
