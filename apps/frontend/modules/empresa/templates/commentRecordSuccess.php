<div id="content_laslistas_right">

  <div class="main cuestionario">
    <div class="top"></div>
    <div class="middle addComentario">
      <h3>Tu comentario sobre <?php echo  $company->getName() . ' en ' . $company->getMunicipioProvincia() ?></h3>

      <form action='<?php echo url_for('lista_negra_empresa_comenta', array('slug' => $company->getSlug())) ?>'
            method="post">

        <?php echo $form->renderHiddenFields(); ?>
        <?php if ($form->hasErrors()): ?>
          <div class="form_row_error">
            <p>Necesitas introducir un comentario.</p>
          </div>
        <?php endif; ?>
        <div>
          <?php echo $form['comentario']->render() ?>
          <div id="error_max_length" class="form_row_error" style="display:none">
            <p>Has superado el espacio permitido para tu comentario</p>
          </div>
        </div>
        <div>
          

        </div>

    </div>
    <div class="bottom"></div>
  </div>

</div>