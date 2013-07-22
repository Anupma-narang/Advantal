<?php use_helper('I18N', 'Date') ?>
<?php include_partial('profesional_tipo_dos/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Nuevo subsector profesional', array(), 'messages') ?></h1>

  <?php include_partial('profesional_tipo_dos/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('profesional_tipo_dos/form_header', array('profesional_tipo_dos' => $profesional_tipo_dos, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('profesional_tipo_dos/form', array('profesional_tipo_dos' => $profesional_tipo_dos, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('profesional_tipo_dos/form_footer', array('profesional_tipo_dos' => $profesional_tipo_dos, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
