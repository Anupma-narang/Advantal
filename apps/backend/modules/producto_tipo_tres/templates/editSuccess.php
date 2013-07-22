<?php use_helper('I18N', 'Date') ?>
<?php include_partial('producto_tipo_tres/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Editar tipo de Producto', array(), 'messages') ?></h1>

  <?php include_partial('producto_tipo_tres/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('producto_tipo_tres/form_header', array('producto_tipo_tres' => $producto_tipo_tres, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('producto_tipo_tres/form', array('producto_tipo_tres' => $producto_tipo_tres, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('producto_tipo_tres/form_footer', array('producto_tipo_tres' => $producto_tipo_tres, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
<style>
    #producto_tipo_tres_producto_tipo_uno_id{
        width:525px!important;
        max-width: 525px!important;
    }
    #producto_tipo_tres_producto_tipo_dos_id{
        width:525px!important;
        max-width: 525px!important;
    }
</style>