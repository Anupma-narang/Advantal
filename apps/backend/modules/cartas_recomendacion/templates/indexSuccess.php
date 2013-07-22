<?php
use_helper('I18N', 'Date');
include_partial('cartas_recomendacion/assets');
?>
<?php include_partial('cartas_recomendacion/assets') ?>


<div id="sf_admin_container">
    <h1><?php echo __('Listado de cartas de recomendación', array(), 'messages') ?></h1>

    <?php include_partial('cartas_recomendacion/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('cartas_recomendacion/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar" class="filters_center" style="float: none;margin: auto;width: 450px;<?php echo (count($filtershow) <= 1) ? 'display: none;' : ''; ?>">
        <?php include_partial('cartas_recomendacion/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
    <?php if (count($filtershow) != 0): ?>
        <div class="clean clear clear_0" >&nbsp;</div>
    <?php endif; ?>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('profesional_letter_cartas_recomendacion_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('cartas_recomendacion/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('cartas_recomendacion/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('cartas_recomendacion/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('cartas_recomendacion/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function() {
        $(".sf_admin_list").css('padding-right', '0px');

        sortProvinciaList("profesional_letter_filters_states_id");

<?php if ($sf_user->hasFlash('alert')): ?>
            alert("<?php echo $sf_user->getFlash('alert') ?>");
<?php endif; ?>
    });

    $("#hide_show_filters").click(function(){
        $("#sf_admin_bar").toggle();
    });

    function disableSectorTres() {
        if ($('#profesional_letter_filters_profesional_tipo_tres_id option').size() <= 1 && $('#profesional_letter_filters_profesional_tipo_dos_id option').size() > 1) {
            $('#profesional_letter_filters_profesional_tipo_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona actividad</option>');
            $('#profesional_letter_filters_profesional_tipo_tres_id').attr('disabled', 'disabled');
        }
        else {

            $('#profesional_letter_filters_profesional_tipo_tres_id').removeAttr('disabled');
        }
    }
    ;

    $(function () {
        disableSectorTres();
        $("#profesional_letter_filters_profesional_tipo_dos_id").change(function () {
            disableSectorTres();

            if($("#profesional_letter_filters_profesional_tipo_dos_id").val() == ''){
                $('#profesional_letter_filters_profesional_tipo_tres_id').attr('disabled', 'disabled');
                //   $('#empresa_filters_empresa_sector_tres_id').removeAttr('disabled');
            }
        })

        if($("#profesional_letter_filters_profesional_tipo_dos_id").val() == ''){
            $('#profesional_letter_filters_profesional_tipo_tres_id').removeAttr('disabled');
        }
        // autoProvincias('empresa_filters');
    });
</script>
