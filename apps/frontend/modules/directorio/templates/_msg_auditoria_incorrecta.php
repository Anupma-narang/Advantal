<?php
use_helper('Date');
if (isset($empresa)) :?>

<p>No puedes volver a auditar esta empresa o entidad hasta
    el <?php echo format_date($sf_user->getProfile()->getProximaAuditoria($empresa)->format('Y-m-d'), 'D')?></p>


<?php elseif (isset($producto)) : ?>
<p>No puedes volver a auditar este producto hasta el <?php echo format_date($sf_user->getProfile()->getProximaAuditoria($producto)->format('Y-m-d'), 'D') ?></p>
<?php endif ?>

