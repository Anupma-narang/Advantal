<?php use_helper('I18N', 'Date') ?>
<?php include_partial('cuestionario/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Listado de cuestionarios de auditoría de Empresa/Entidad', array(), 'messages') ?></h1>

    <?php include_partial('cuestionario/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('cuestionario/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar" class="filters_center" style="float: none;margin: auto;width: 425px;<?php echo (count($filtershow) <= 1) ? 'display: none;' : ''; ?>">
        <?php include_partial('cuestionario/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
    <?php if (count($filtershow) != 0): ?>
        <div class="clean clear clear_0" >&nbsp;</div>
    <?php endif; ?>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('cuestionario_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('cuestionario/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('cuestionario/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('cuestionario/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('cuestionario/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
<style type="text/css">
    th.sf_admin_list_th_sector{width: 350px !important;}
</style>
<script type='text/javascript'>
      $(document).ready(function() {
        $(".sf_admin_list").css('padding-right', '0px');
<?php if ($sf_user->hasFlash('alert')): ?>
            alert("<?php echo $sf_user->getFlash('alert') ?>");
<?php endif; ?>
    });
    $("#hide_show_filters").click(function(){
        $("#sf_admin_bar").toggle();
    });
    function disableSectorTres(id) {
        if ($('#lista_cuestionario_filters_empresa_sector_tres_id option').size() <= 1 && $('#lista_cuestionario_filters_empresa_sector_dos_id option').size() > 1) {
            $('#lista_cuestionario_filters_empresa_sector_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona actividad</option>');
            $('#lista_cuestionario_filters_empresa_sector_tres_id').attr('disabled', 'disabled');
        }
        else
            $('#lista_cuestionario_filters_empresa_sector_tres_id').removeAttr('disabled');
    }
    ;
    
    $("#lista_cuestionario_filters_empresa_sector_dos_id").change(function() {
        disableSectorTres();
    });
    
    $("#lista_cuestionario_producto_tipo_dos_id").change(function () {
        disableSectorTres();
    });




</script>