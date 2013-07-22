<?php $city = Doctrine::getTable('City')->find($gift_redemption->getCityId());?>
<?php echo $city? $city->getName() :'';?>
