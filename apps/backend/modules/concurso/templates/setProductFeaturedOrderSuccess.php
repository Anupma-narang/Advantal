<div id="sf_admin_container">
  <h1>Asignar orden Home</h1>
  <div id="Asignacion_puntos_content">
    <div id="Asignacion_puntos_inner">
      <form id="Puntos_form" action="<?php echo url_for('contest_product_featured_order', array('id' => $contest_id))?>" method="POST">
        <fieldset id="sf_fieldset_none">
          <div class="sf_admin_form_row">
            <?php if ($error_message): ?>
                <ul class="error_list">
                  <li><?php echo $error_message; ?></li>
                </ul>
              <?php endif; ?>
            <div>
              <label>Introduce un orden:</label>
              <div class="content"><input class="tamano_2_c" type="text" maxlength="2" name="featured_order" value="<?php echo $contest_featured_order ?>"></div>
       </div>
          </div>
        </fieldset>
        <ul class="sf_admin_actions">
          <li class="sf_admin_action_list">
            <a href="<?php echo url_for('concurso')?>">Volver al Listado</a>
          </li>
          <li class="sf_admin_action_save">
            <input type="submit" value="Guardar" id="submit_cmd" />
          </li>
        </ul>
      </form>
    </div>
  </div>
</div>


