<?php use_helper('I18N', 'Date') ?>
<?php include_partial('product_case_study/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Listado de nuestros casos de éxito de Producto', array(), 'messages') ?></h1>

    <?php include_partial('product_case_study/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('product_case_study/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar" align="center" style="float: none;margin: 0 auto;width: 100%;">
        <?php include_partial('product_case_study/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('product_case_study_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('product_case_study/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('product_case_study/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('product_case_study/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('product_case_study/list_footer', array('pager' => $pager)) ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#hide_show_filters").click(function(){
            $("#sf_admin_bar").toggle();
            $("#abc").toggle();
        });

        if('<?php echo count($filtershow) <= 1; ?>'){
            $("#sf_admin_bar").hide();
        }

        $("#product_case_study_filters_producto_tipo_uno_id").change(function () {
            disableSectorTres();
            if ($('#product_case_study_filters_producto_tipo_uno_id option:selected').val()>0) {

            }
        });
    });

    function disableSectorTres() {
        if ($('#product_case_study_filters_producto_tipo_tres_id option').size() <= 1 && $('#company_case_study_filters_empresa_sector_dos_id option').size() > 1) {
            $('#product_case_study_filters_producto_tipo_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona tipo de producto</option>');
            $('#product_case_study_filters_producto_tipo_tres_id').attr('disabled', 'disabled');
        }
        else
            $('#product_case_study_filters_producto_tipo_tres_id').removeAttr('disabled');
    }
</script>