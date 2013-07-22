<?php use_helper('I18N', 'Date') ?>
<?php include_partial('user_company_case_study/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Listado de otros casos de éxito de Empresa/Entidad', array(), 'messages') ?></h1>

    <?php include_partial('user_company_case_study/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('user_company_case_study/list_header', array('pager' => $pager)) ?>
    </div>

    <div class="clear"></div>

    <div id="sf_admin_bar"  align="center" style="float: none;margin: 0 auto;width: 100%;<?php echo (count($filtershow) <= 1) ? 'display: none;' : 'block;'; ?>">
        <?php include_partial('user_company_case_study/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

    <?php if (count($filtershow) != 0): ?>
        <div class="clean clear clear_0" >&nbsp;</div>
    <?php endif; ?>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('user_company_case_study_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('user_company_case_study/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('user_company_case_study/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('user_company_case_study/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('user_company_case_study/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        sortProvinciaList("user_company_case_study_filters_states_id");

        $("#hide_show_filters").click(function(){
            $("#sf_admin_bar").toggle();
            $("#abc").toggle();
        });

        if('<?php echo count($filtershow) <= 1; ?>'){
            $("#sf_admin_bar").hide();
        }
    });

    function disableSectorTres() {
        if ($('#company_case_study_filters_empresa_sector_tres_id option').size() <= 1 && $('#company_case_study_filters_empresa_sector_dos_id option').size() > 1) {
            $('#company_case_study_filters_empresa_sector_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona tipo de producto</option>');
            $('#company_case_study_filters_empresa_sector_tres_id').attr('disabled', 'disabled');
        }
        else
            $('#company_case_study_filters_empresa_sector_tres_id').removeAttr('disabled');
    }

    function ceuta_melilla(f,g){
        var state2city = new Array();<?php foreach (StatesTable::getCiudadesAutonomas() as $city)
            printf('state2city[%d]=%d;', $city['states_id'], $city['id']) ?>
                    if(state2city[f.val()]) g.val(state2city[f.val()]).attr("disabled","disabled");
                }
</script>