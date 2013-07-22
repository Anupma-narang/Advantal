
<?php if ($sf_user->isAuthenticated()): ?>
    <?php include_component('sfApply', 'login') ?>
<?php else: ?>
    <div class="subtitulo"> ¡Hazte colaborador ya!</div>
    <?php echo link_to("crea una cuenta", "sfApply/apply", array('class'=>'href_boton_red blanco','title'=>'crea una cuenta')); ?>
    <?php echo link_to("ya soy colaborador", "guard/login", array('class'=>'href_boton_gray blanco','title'=>'ya soy colaborador')) ?>
<?php endif; ?>
         