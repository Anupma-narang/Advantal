<?php use_helper('I18N', 'Date') ?>
<?php include_partial('profesional_tipo_tres/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Nueva actividad profesional', array(), 'messages') ?></h1>

  <?php include_partial('profesional_tipo_tres/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('profesional_tipo_tres/form_header', array('profesional_tipo_tres' => $profesional_tipo_tres, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('profesional_tipo_tres/form', array('profesional_tipo_tres' => $profesional_tipo_tres, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('profesional_tipo_tres/form_footer', array('profesional_tipo_tres' => $profesional_tipo_tres, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
