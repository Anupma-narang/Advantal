<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/JqueryAutocomplete.css') ?>

<div class="sf_admin_form">
    <?php echo form_tag_for($form, '@user_company_case_study') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('user_company_case_study/form_fieldset', array('user_company_case_study' => $user_company_case_study, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('user_company_case_study/form_actions', array('user_company_case_study' => $user_company_case_study, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        //$("ul.error_list:first").remove();
     $("form").bind("submit",function(){$("#user_company_case_study_city_id").removeAttr("disabled");});
        $("#user_company_case_study_states_id").change(function(){ ceuta_melilla($(this),$("#user_company_case_study_city_id")) });

        ceuta_melilla($("#user_company_case_study_states_id"),$("#user_company_case_study_city_id"));

        $('#user_company_case_study_empresa_sector_dos_id').change(function(){
            if($('#user_company_case_study_empresa_sector_tres_id option').size() == 1){
                $('#user_company_case_study_empresa_sector_tres_id').attr('disabled','disabled');
            }
        });

        $('#user_company_case_study_empresa_sector_dos_id').each(function(){
            if($('#user_company_case_study_empresa_sector_dos_id option:selected').val()){
                if($('#user_company_case_study_empresa_sector_tres_id option').size() == 1){
                    $('#user_company_case_study_empresa_sector_tres_id').attr('disabled','disabled');
                }
            }
        });

        $('.sf_admin_form_field_description').prepend('<div id="error_max_length" style="display:none;">Has superado el espacio permitido para la descripción del caso de éxito.</div>');
        $('.sf_admin_form_field_summary').prepend('<div id="error_max_length_summary" style="display:none;">Has superado el espacio permitido para el resumen del caso de éxito.</div>');

    });

    function ceuta_melilla(f,g){
        var state2city = new Array();<?php
    foreach (StatesTable::getCiudadesAutonomas() as $city)
        printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
        ?>

                if(state2city[f.val()]) g.val(state2city[f.val()]).attr("disabled","disabled");
            }
</script>

