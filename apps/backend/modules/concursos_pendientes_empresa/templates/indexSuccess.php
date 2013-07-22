<?php use_helper('I18N', 'Date') ?>
<?php include_partial('concursos_pendientes_empresa/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Concursos pendientes de Empresa/Entidad', array(), 'messages') ?></h1>

    <?php include_partial('concursos_pendientes_empresa/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('concursos_pendientes_empresa/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar" align="center" style="float: none;margin: 0 auto;width: 100%;<?php echo (count($filtershow) <= 1) ? 'display: none;' : ''; ?>">
        <?php include_partial('concursos_pendientes_empresa/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
    <?php if (count($filtershow) != 0): ?>
        <div class="clean clear clear_0" >&nbsp;</div>
    <?php endif; ?>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('concurso_concursos_pendientes_empresa_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('concursos_pendientes_empresa/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('concursos_pendientes_empresa/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('concursos_pendientes_empresa/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('concursos_pendientes_empresa/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
<script language="javascript">
    $(document).ready(function() {
        sortProvinciaList("concurso_filters_states_id");

        $("#hide_show_filters").click(function() {
            $("#sf_admin_bar").toggle();
        });


        $("#concurso_filters_states_id").change(function() {
            ceuta_melilla($(this), $("#concurso_filters_city_id"))
        });
        ceuta_melilla($("#concurso_filters_states_id"), $("#concurso_filters_city_id"));

        disableSectorTres();
        $("#concurso_filters_empresa_sector_dos_id").change(function() {
            disableSectorTres();

            if ($("#concurso_filters_empresa_sector_dos_id").val() == '') {
                $('#concurso_filters_empresa_sector_tres_id').attr('disabled', 'disabled');
                //   $('#empresa_filters_empresa_sector_tres_id').removeAttr('disabled');
            }
        })

        if ($("#concurso_filters_empresa_sector_dos_id").val() == '') {
            $('#concurso_filters_empresa_sector_tres_id').removeAttr('disabled');
        }
    });

    function ceuta_melilla(f, g) {
        var state2city = new Array();<?php
        foreach (StatesTable::getCiudadesAutonomas() as $city)
            printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
            ?>
        if (state2city[f.val()])
            g.val(state2city[f.val()]).attr("disabled", "disabled");
    }

    function disableSectorTres() {
        if ($('#concurso_filters_empresa_sector_tres_id option').size() <= 1 && $('#concurso_filters_empresa_sector_dos_id option').size() > 1) {
            $('#concurso_filters_empresa_sector_tres_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Selecciona actividad</option>');
            $('#concurso_filters_empresa_sector_tres_id').attr('disabled', 'disabled');
        }
        else {

            $('#concurso_filters_empresa_sector_tres_id').removeAttr('disabled');
        }
    }
    ;


</script>
