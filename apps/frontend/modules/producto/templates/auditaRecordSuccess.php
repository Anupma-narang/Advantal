
  
  <div id="" class="main">
    <div class="top"></div>
    <div class="middle_audit">
      <div  >
        <div class="main cuestionario">
          <h3>Cuestionario de la empresa <strong><?php echo $product->getName() ?></strong></h3>
          <form action="<?php echo url_for('lista_blanca_audita_empresa', array('slug' => $product->getSlug())) ?>"
                method="post">

            <?php if ($form->hasErrors()): ?>
              <div class="form_row_error">
                <p><strong>Para auditar necesitas dar tu opinión en todas la preguntas</strong>.</p>
              </div>
            <?php endif; ?>

            <?php echo $form->renderHiddenFields() ?>

            <div class='preguntas'>

              <?php foreach ($form['Preguntas'] as $pregunta) : ?>
                <?php echo $pregunta->render(); ?>
              <?php endforeach ?>
              <div id="error_max_length" class="form_row_error" style="display:none">
                <p>Has superado el espacio permitido para tus comentarios</p>
              </div>
              
            </div>
          </form>
        </div>
        <!-- fi div middle -->
        <div class="bottom"></div>
      </div>
      <div class="bottom"></div>
    </div>
  </div>
  <div class="content-bottom"></div>
