<?php use_helper('I18N', 'Date') ?>
<?php include_partial('concursos_pendientes_product/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Concursos pendientes de Producto', array(), 'messages') ?></h1>

    <?php include_partial('concursos_pendientes_product/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('concursos_pendientes_product/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar" align="center" style="float: none;margin: auto;width: 100%;<?php echo (count($filtershow) <= 1) ? 'display: none;' : ''; ?>">
        <?php include_partial('concursos_pendientes_product/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
    <?php if (count($filtershow) != 0): ?>
        <div class="clean clear clear_0" >&nbsp;</div>
    <?php endif; ?>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('concurso_concursos_pendientes_product_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('concursos_pendientes_product/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('concursos_pendientes_product/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('concursos_pendientes_product/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('concursos_pendientes_product/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
<script language="javascript">
    $(document).ready(function() {
        if('<?php echo!count($filtershow); ?>'){
            $("#sf_admin_bar").hide();
        }
    
    });
  
    $("#hide_show_filters").click(function(){
        $("#sf_admin_bar").toggle();
    });
  
    function disableSectorTres() {
        if ($('#concurso_filters_producto_tipo_tres_id option').size() <= 1 && $('#concurso_filters_producto_tipo_dos_id option').size() > 1) {
            $('#concurso_filters_producto_tipo_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona tipo de producto</option>');
            $('#concurso_filters_producto_tipo_tres_id').attr('disabled', 'disabled');
        }
        else {

            $('#concurso_filters_producto_tipo_tres_id').removeAttr('disabled');
        }
    }
    ;
    
    $(function () {
        disableSectorTres();
        $("#concurso_filters_producto_tipo_dos_id").change(function () {
            disableSectorTres();
            
            if($("#concurso_filters_producto_tipo_dos_id").val() == ''){
                $('#concurso_filters_producto_tipo_tres_id').attr('disabled', 'disabled');
                //   $('#empresa_filters_empresa_sector_tres_id').removeAttr('disabled');
            }
        })

        if($("#concurso_filters_producto_tipo_dos_id").val() == ''){
            $('#concurso_filters_producto_tipo_tres_id').removeAttr('disabled');
        }
    });
</script>

