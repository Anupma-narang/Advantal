<?php $localidad_id = $auditanos->getsfGuardUser()->getProfile()->getCityId(); ?>
<?php if ($localidad_id): ?>
    <?php echo $auditanos->getsfGuardUser()->getProfile()->getCity()->getName(); ?>
<?php else: ?>
    <?php echo $auditanos->getsfGuardUser()->getProfile()->getStates()->getName(); ?>
<?php endif; ?>
