<?php use_helper('I18N', 'Date') ?>
<?php include_partial('profesionales_pendientes/assets') ?>

<div id="sf_admin_container">

    <h1><?php echo __('Profesionales pendientes', array(), 'messages') ?></h1>

    <?php include_partial('profesionales_pendientes/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('profesionales_pendientes/list_header', array('pager' => $pager, 'type' => isset($type) ? $type : null)) ?>
    </div>

    <div id="sf_admin_bar" class="filters_center" style="float: none;margin: auto;width:450px;<?php echo (count($filtershow) <= 1) ? 'display: none;' : ''; ?>">
        <?php include_partial('profesionales_pendientes/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
    <?php if (count($filtershow) != 0): ?>
        <div class="clean clear clear_0" >&nbsp;</div>
    <?php endif; ?>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('profesionales_pendientes_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('profesionales_pendientes/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('profesionales_pendientes/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('profesionales_pendientes/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('profesionales_pendientes/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
<script language="javascript">
    $(document).ready(function() {
        $(".sf_admin_list").css('padding-right', '0px');
        sortProvinciaList("profesional_filters_states_id");
        
<?php if ($sf_user->hasFlash('alert')): ?>
            alert("<?php echo $sf_user->getFlash('alert') ?>");
<?php endif; ?>
    });

    $("#hide_show_filters").click(function(){
        $("#sf_admin_bar").toggle();
    });

    function disableSectorTres() {
        if ($('#profesional_filters_profesional_tipo_tres_id option').size() <= 1 && $('#profesional_filters_profesional_tipo_dos_id option').size() > 1) {
            $('#profesional_filters_profesional_tipo_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona actividad</option>');
            $('#profesional_filters_profesional_tipo_tres_id').attr('disabled', 'disabled');
        }
        else {

            $('#profesional_filters_profesional_tipo_tres_id').removeAttr('disabled');
        }
    }
    ;

    $(function () {
        disableSectorTres();
        $("#profesional_filters_profesional_tipo_dos_id").change(function () {
            disableSectorTres();

            if($("#profesional_filters_profesional_tipo_dos_id").val() == ''){
                $('#profesional_filters_profesional_tipo_tres_id').attr('disabled', 'disabled');
                //   $('#empresa_filters_empresa_sector_tres_id').removeAttr('disabled');
            }
        })

        if($("#profesional_filters_profesional_tipo_dos_id").val() == ''){
            $('#profesional_filters_profesional_tipo_tres_id').removeAttr('disabled');
        }
    });


</script>
