<?php use_helper('I18N', 'Date') ?>
<?php include_partial('cuestionario/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Editar cuestionario de auditoría de Empresa/Entidad', array(), 'messages') ?></h1>

    <?php include_partial('cuestionario/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('cuestionario/form_header', array('lista_cuestionario' => $lista_cuestionario, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('cuestionario/form', array('lista_cuestionario' => $lista_cuestionario, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('cuestionario/form_footer', array('lista_cuestionario' => $lista_cuestionario, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>
</div>
<script type="text/javascript">
    $(".sf_admin_form tr th").remove();
</script>