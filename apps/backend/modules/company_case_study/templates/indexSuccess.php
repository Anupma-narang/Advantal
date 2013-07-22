<?php use_helper('I18N', 'Date') ?>
<?php include_partial('company_case_study/assets') ?>
<?php use_helper('jQuery'); ?>
<?php use_javascript('ckeditor/ckeditor.js') ?>
<?php use_javascript('provincias_backend.js') ?>
<?php use_javascript('reorder_combobox.js') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Listado de nuestros casos de éxito de Empresa/Entidad', array(), 'messages') ?></h1>

    <?php include_partial('company_case_study/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('company_case_study/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar" align="center" style="float: none;margin: 0 auto;width: 100%;">
        <?php include_partial('company_case_study/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('company_case_study_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('company_case_study/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('company_case_study/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('company_case_study/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('company_case_study/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#company_case_study_filters_states_id").change(function(){ ceuta_melilla($(this),$("#company_case_study_filters_city_id")) });
        $("#company_case_study_filters_states_id").each(function(){ ceuta_melilla($(this),$("#company_case_study_filters_city_id")) });
        sortProvinciaList("company_case_study_filters_states_id");

        $("#hide_show_filters").click(function(){
            $("#sf_admin_bar").toggle();
            $("#abc").toggle();
        });

        if('<?php echo count($filtershow) <= 1; ?>'){
            $("#sf_admin_bar").hide();
        }
    });

    function disableSectorTres() {
        if ($('#company_case_study_empresa_sector_tres_id option').size() <= 1 && $('#company_case_study_empresa_sector_dos_id option').size() > 1) {
            $('#company_case_study_empresa_sector_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona actividad</option>');
            $('#company_case_study_empresa_sector_tres_id').attr('disabled', 'disabled');
        }
        else
            $('#company_case_study_empresa_sector_tres_id').removeAttr('disabled');
    }
    ;

    $("#company_case_study_empresa_sector_uno_id").change(function(){
        if ($('#company_case_study_empresa_sector_uno_id option:selected').val()>0) {
            reorder_combobox('company_case_study_empresa_sector_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?empresa_sector_uno_id='+$('#company_case_study_empresa_sector_uno_id option:selected').val());
        }
    });

    $("#company_case_study_empresa_sector_dos_id").change(function () {
        // disableSectorTres();
        if ($('#company_case_study_empresa_sector_dos_id option:selected').val()>0) {
            reorder_combobox('company_case_study_empresa_sector_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?empresa_sector_dos_id='+$('#company_case_study_empresa_sector_dos_id option:selected').val());
        }
    });




    function ceuta_melilla(f,g){
        var state2city = new Array();<?php
        foreach (StatesTable::getCiudadesAutonomas() as $city)
            printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
            ?>
                    if(state2city[f.val()]) g.val(state2city[f.val()]).attr("disabled","disabled");
                }
</script>