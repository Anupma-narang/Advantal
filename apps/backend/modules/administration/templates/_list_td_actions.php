<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_assign_permission">
      <?php echo link_to(__('Asignar permisos', array(), 'messages'), 'administration/assignPermission?id=' . $sf_guard_user->getId(), array()) ?>
    </li>
    <?php if ($sf_guard_user->getId() == $sf_user->getAttribute('change_password_id', false)): ?>
      <li class="sf_admin_action_change_password">
        <?php echo link_to(__('Cambiar contraseña', array(), 'messages'), 'administration/changePassword?id=' . $sf_guard_user->getId(), array()) ?>
      </li>
    <?php endif; ?>
  </ul>
</td>
