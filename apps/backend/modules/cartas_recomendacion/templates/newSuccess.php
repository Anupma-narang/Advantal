<?php use_helper('I18N', 'Date') ?>
<?php include_partial('profesionales_pendientes/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Nuevo profesional', array(), 'messages') ?></h1>

  <?php include_partial('profesionales_pendientes/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('profesionales_pendientes/form_header', array('profesional' => $profesional, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('profesionales_pendientes/form', array('profesional' => $profesional, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('profesionales_pendientes/form_footer', array('profesional' => $profesional, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
