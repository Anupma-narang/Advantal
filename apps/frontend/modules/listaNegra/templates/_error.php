    <?php
use_helper('Date');
if ($type == 'empresa') :?>
<p>Sólo puedes comentar 5 empresas, entidades o productos por día.</p>


<?php elseif ($type == 'producto') : ?>
<p>Sólo puedes comentar 5 empresas, entidades o productos por día.</p>
<?php endif ?>

