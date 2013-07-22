<div id="sf_admin_container">
  <h1>Asignar permisos</h1>
  <h3><?php echo $user->getUsername() ?></h3>
  <div id="Asignacion_puntos_content">
    <div id="Asignacion_puntos_inner">
      <form id="permission" action="" method="POST">
        <fieldset id="sf_fieldset_none" >
          <div class="sf_admin_form_row">
            <?php if ($permission_form->hasErrors()): ?>
              <?php echo $permission_form->renderGlobalErrors(); ?>
            <?php endif; ?>
            <div>
              <?php echo $permission_form['permission']->renderError(); ?>
              <?php if (isset($error_message)): ?>
                <ul class="error_list">
                  <li><?php echo $error_message;?></li>
                </ul>
              <?php endif; ?>
              <label style="line-height: 20px;"><strong>Perfil de Usuario</strong>:</label>
              <?php echo $permission_form['permission']->render();
              ?>
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


