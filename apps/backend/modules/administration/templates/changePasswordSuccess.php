<div id="sf_admin_container">
  <h1>Cambio contraseña Administración</h1>
  <h3><?php echo $user->getUsername() ?></h3>
  <div id="Asignacion_puntos_content">
    <div id="Asignacion_puntos_inner">
      <form id="password" action="" method="POST">
        <fieldset id="sf_fieldset_none">
          <div class="sf_admin_form_row">
            <?php if ($sf_user_form->hasErrors()): ?>
              <?php echo $sf_user_form['password']->renderError(); ?>
            <?php endif; ?>
            <div>
              <label style="margin-right: 5px;padding: 0 10px;width: 171px;"><b>Contraseña Administración</b></label>
              <div class="content">
                <?php echo $sf_user_form['password']->render(); ?>
              </div>
            </div>
          </div>
        </fieldset>
        <ul class="sf_admin_actions">
          <li class="sf_admin_action_list">
            <?php echo link_to('Volver al Listado', url_for('sf_guard_user')) ?>
          </li>
          <li class="sf_admin_action_save">
            <input type="submit" value="Guardar" id="submit_cmd" />
          </li>
        </ul>
      </form>
    </div>
  </div>
</div>


