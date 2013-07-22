<?php use_helper('I18N', 'Date') ?>
<?php include_partial('contribucion/assets') ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/JqueryAutocomplete.css') ?>
<div id="sf_admin_container">
  <h1><?php echo __('Nueva contribución', array(), 'messages') ?></h1>

  <?php include_partial('contribucion/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('contribucion/form_header', array('contribucion' => $contribucion, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('contribucion/form', array('contribucion' => $contribucion, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('contribucion/form_footer', array('contribucion' => $contribucion, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
