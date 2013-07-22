<?php if ($contratanos->getCityId()): ?>
    <?php $city = Doctrine::getTable('City')->find($contratanos->getCityId()); ?>
    <?php echo $city->getName(); ?>
<?php else: ?>
    <?php $state = Doctrine::getTable('States')->find($contratanos->getStatesId()); ?>
    <?php echo $state->getName(); ?>
<?php endif; ?>