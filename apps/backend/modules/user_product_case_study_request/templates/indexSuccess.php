<?php use_helper('I18N', 'Date') ?>
<?php include_partial('user_product_case_study_request/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Listado de casos de éxito de Producto', array(), 'messages') ?></h1>

    <?php include_partial('user_product_case_study_request/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('user_product_case_study_request/list_header', array('pager' => $pager)) ?>
    </div>

    <div class="clear"></div>
    <div style="width:100%; padding-bottom: 8px;">
      <a id="hide_show_filters" href="javascript:void(0);" style=" bottom: 0;display: block;margin-right: 0;margin-top: -7px;right: 0;text-align: center;top: 0;width: 100%;"><strong>Esconder/Mostrar filtros</strong></a>
    </div>
    
    <div id="sf_admin_bar"  align="center" style="float: none;margin: 0 auto;width: 100%;<?php echo (count($filtershow) <= 1) ? 'display: none;' : ''; ?>">
        <?php include_partial('user_product_case_study_request/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

    <?php if (count($filtershow) != 0): ?>
        <div class="clean clear clear_0" >&nbsp;</div>
    <?php endif; ?>


    <div id="sf_admin_content">
        <form action="<?php echo url_for('user_product_case_study_request_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('user_product_case_study_request/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('user_product_case_study_request/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('user_product_case_study_request/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('user_product_case_study_request/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
<script type='text/javascript'>

    $("#hide_show_filters").click(function() {
        $("#sf_admin_bar").toggle();
        $("#abc").toggle();
    });

    function disableSectorTres() {
        if ($('#user_product_case_study_request_filters_producto_tipo_tres_id option').size() <= 1 && $('#user_product_case_study_request_filters_producto_tipo_dos_id option').size() > 1) {
            $('#user_product_case_study_request_filters_producto_tipo_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona tipo de producto</option>');
            $('#user_product_case_study_request_filters_producto_tipo_tres_id').attr('disabled', 'disabled');
        }
        else {

            $('#user_product_case_study_request_filters_producto_tipo_tres_id').removeAttr('disabled');
        }
    }
    ;

    $(function () {
        disableSectorTres();
        $("#user_product_case_study_request_filters_producto_tipo_dos_id").change(function () {
            disableSectorTres();
            if($("#user_product_case_study_request_filters_producto_tipo_dos_id").val() == ''){
                $('#user_product_case_study_request_filters_producto_tipo_tres_id').attr('disabled', 'disabled');
                //$('#producto_filters_producto_tipo_tres_id').removeAttr('disabled');
            }
        })

        if($("#user_product_case_study_request_filters_producto_tipo_dos_id").val() == ''){
            $('#user_product_case_study_request_filters_producto_tipo_tres_id').removeAttr('disabled');
        }
    });
</script>
