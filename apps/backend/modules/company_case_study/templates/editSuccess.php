<?php use_helper('I18N', 'Date') ?>
<?php include_partial('company_case_study/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Editar caso de éxito de Empresa/Entidad', array(), 'messages') ?></h1>

    <?php include_partial('company_case_study/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('company_case_study/form_header', array('company_case_study' => $company_case_study, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('company_case_study/form', array('company_case_study' => $company_case_study, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('company_case_study/form_footer', array('company_case_study' => $company_case_study, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>
</div>
<script type="text/javascript">                
    $(document).ready(function() {
        $("#company_case_study_states_id").change(function(){ ceuta_melilla($(this),$("#company_case_study_city_id")) });
        $("#company_case_study_states_id").each(function(){ ceuta_melilla($(this),$("#company_case_study_city_id")) });
    });
    
    $('#company_case_study_empresa_sector_dos_id').change(function(){
        if($('#company_case_study_empresa_sector_tres_id option').size() == 1){
            $('#company_case_study_empresa_sector_tres_id').attr('disabled','disabled');
        }
    });

    $('#company_case_study_empresa_sector_dos_id').each(function(){
        if($('#company_case_study_empresa_sector_dos_id option:selected').val()){
            if($('#company_case_study_empresa_sector_tres_id option').size() == 1){
                $('#company_case_study_empresa_sector_tres_id').attr('disabled','disabled');
            }
        }
    });
    
    function ceuta_melilla(f,g){
        var state2city = new Array();<?php foreach (StatesTable::getCiudadesAutonomas() as $city)
            printf('state2city[%d]=%d;', $city['states_id'], $city['id']) ?>
                    if(state2city[f.val()]) g.val(state2city[f.val()]).attr("disabled","disabled");
                }      
</script>
