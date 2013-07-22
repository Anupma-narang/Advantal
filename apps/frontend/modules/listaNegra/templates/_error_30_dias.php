    <?php
use_helper('Date');
if ($type == 'empresa') :?>
<p>No puedes volver a comentar esta empresa o entidad hasta
    el <?php echo format_date($sf_user->getProfile()->getProximoComentario($sf_data->getRaw('object'))->format('Y-m-d'), 'D')?></p>


<?php elseif ($type == 'producto') : ?>
<p>No puedes volver a comentar este producto hasta
    el <?php echo format_date($sf_user->getProfile()->getProximoComentario($sf_data->getRaw('object'))->format('Y-m-d'), 'D')?></p>
<?php endif ?>

