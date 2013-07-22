<div id="sf_admin_container">
  <h1>Asignar orden Home</h1>
  <div id="Asignacion_puntos_content">
    <div id="Asignacion_puntos_inner">
      <form id="Puntos_form" action="<?php echo url_for('profesional_order', array('id' => $profesional_id))?>" method="POST">
        <fieldset id="sf_fieldset_none">
          <div class="sf_admin_form_row">
            <?php if ($error_message): ?>
                <ul class="error_list">
                  <li><?php echo $error_message; ?></li>
                </ul>
              <?php endif; ?>
            <div>
              <label>Introduce un orden:</label>
              <div class="content"><input class="tamano_2_c" type="text" maxlength="2" name="featured_order" value="<?php echo $profesional_featured_order ?>"></div>
              
       </div>
          </div>
        </fieldset>
        <ul class="sf_admin_actions">
          <li class="sf_admin_action_list">
            <?php echo link_to('Volver al Listado', url_for('profesional_lista'))?>
          </li>
          <li class="sf_admin_action_save">
            <input type="submit" value="Guardar" id="submit_cmd" />
          </li>
        </ul>
      </form>
    </div>
  </div>
</div>


