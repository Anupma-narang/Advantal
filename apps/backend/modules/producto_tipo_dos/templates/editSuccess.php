<?php use_helper('I18N', 'Date') ?>
<?php include_partial('producto_tipo_dos/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Editar subsector del Producto', array(), 'messages') ?></h1>

  <?php include_partial('producto_tipo_dos/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('producto_tipo_dos/form_header', array('producto_tipo_dos' => $producto_tipo_dos, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('producto_tipo_dos/form', array('producto_tipo_dos' => $producto_tipo_dos, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('producto_tipo_dos/form_footer', array('producto_tipo_dos' => $producto_tipo_dos, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
<style>
    #sf_admin_container label{
        width:13em!important;
    }
    #producto_tipo_dos_producto_tipo_uno_id{
        width:525px!important;
        max-width: 525px!important;
    }
</style>