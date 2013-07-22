<?php use_helper('I18N', 'Date') ?>
<?php include_partial('empresaListaBlanca/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Editar Empresa/Entidad en Lista blanca', array(), 'messages') ?></h1>

  <?php include_partial('empresaListaBlanca/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('empresaListaBlanca/form_header', array('empresa' => $empresa, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('empresaListaBlanca/form', array('empresa' => $empresa, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('empresaListaBlanca/form_footer', array('empresa' => $empresa, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
