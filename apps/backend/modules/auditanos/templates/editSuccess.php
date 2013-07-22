<?php use_helper('I18N', 'Date') ?>
<?php include_partial('auditanos/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Editar formulario de Audítanos', array(), 'messages') ?></h1>

  <?php include_partial('auditanos/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('auditanos/form_header', array('auditanos' => $auditanos, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('auditanos/form', array('auditanos' => $auditanos, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('auditanos/form_footer', array('auditanos' => $auditanos, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
