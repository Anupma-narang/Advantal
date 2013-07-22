<?php use_helper('I18N', 'Date') ?>
<?php include_partial('contribuciones_pendientes/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Nueva contribución pendiente', array(), 'messages') ?></h1>

  <?php include_partial('contribuciones_pendientes/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('contribuciones_pendientes/form_header', array('contribucion' => $contribucion, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('contribuciones_pendientes/form', array('contribucion' => $contribucion, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('contribuciones_pendientes/form_footer', array('contribucion' => $contribucion, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
<script>
$(function() {
    $('.sf_admin_form_field_numero').hide();
    $('.sf_admin_form_field_slug').hide();
    });
</script>
