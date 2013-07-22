<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/JqueryAutocomplete.css') ?>

<style type="text/css">
    #sf_admin_container label{
        width: 11em;
    }
    #sf_admin_container .sf_admin_form_row .content{
        padding-left: 12em;
    }
</style>
<div class="sf_admin_form">
    <?php echo form_tag_for($form, '@user_product_case_study') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('user_product_case_study/form_fieldset', array('user_product_case_study' => $user_product_case_study, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('user_product_case_study/form_actions', array('user_product_case_study' => $user_product_case_study, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>
<script type="text/javascript">
    $(document).ready(function(){
       // $("ul.error_list:first").remove();  
        
        $('.sf_admin_form_field_description').prepend('<div id="error_max_length" style="display:none;">Has superado el espacio permitido para la descripción del caso de éxito.</div>');
        $('.sf_admin_form_field_summary').prepend('<div id="error_max_length_summary" style="display:none;">Has superado el espacio permitido para el resumen del caso de éxito.</div>');
        
        $('#user_product_case_study_producto_tipo_dos_id').change(function(){
            if($('#user_product_case_study_producto_tipo_tres_id option').size() == 1){
                $('#user_product_case_study_producto_tipo_tres_id').attr('disabled','disabled');
            }
        });

        $('#user_product_case_study_producto_tipo_dos_id').each(function(){
            if($('#user_product_case_study_producto_tipo_dos_id option:selected').val()){
                if($('#user_product_case_study_producto_tipo_tres_id option').size() == 1){
                    $('#user_product_case_study_producto_tipo_tres_id').attr('disabled','disabled');
                }
            }
        }); 
    });
</script>