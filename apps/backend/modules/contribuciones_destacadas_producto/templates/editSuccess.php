<?php use_helper('I18N', 'Date') ?>
<?php include_partial('contribuciones_destacadas_producto/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Editar contribución destacadada de Producto', array(), 'messages') ?></h1>

    <?php include_partial('contribuciones_destacadas_producto/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('contribuciones_destacadas_producto/form_header', array('contribucion' => $contribucion, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('contribuciones_destacadas_producto/form', array('contribucion' => $contribucion, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('contribuciones_destacadas_producto/form_footer', array('contribucion' => $contribucion, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>
</div>
