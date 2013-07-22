<?php use_helper('Text') ?>

<div id="sf_admin_container">
  <h1>Correos Administradores</h1>

  <div id="sf_admin_content">
    <h2>
      <?php echo __('Correos Administradores') ?>
    </h2>
    <ul class="dragbox-content">
      <li><span class="bold"><?php echo __('Creado el: ') ?></span><?php echo date('d/m/Y', strtotime($administration_emails->getCreatedAt())); ?></li>
      <li><span class="bold"><?php echo __('Correo electrónico: ') ?></span><?php echo $administration_emails->getEmail(); ?></li>
      <li><span class="bold"><?php echo __('Perfil: ') ?></span><?php echo $administration_emails->getPermission() ? $administration_emails->getPermission()->getName() : '' ?></li>
      <li><span class="bold"><?php echo __('Usuario: ') ?></span><?php echo $administration_emails->getUser() ? $administration_emails->getUser()->getUsername() : ''  ?></li>
    </ul>
  </div>
  <ul class="sf_admin_actions">
    <li class="sf_admin_action_list"><a href="<?php echo url_for('administration_emails') ?>">Volver al Listado</a></li>
  </ul>
</div>