<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/JqueryAutocomplete.css') ?>
<?php use_helper('jQuery'); ?>
<?php use_javascript('ckeditor/ckeditor.js') ?>
<?php use_javascript('reorder_combobox.js') ?>
<div class="sf_admin_form">
    <?php echo form_tag_for($form, '@user_product_case_study_request') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('user_product_case_study_request/form_fieldset', array('user_product_case_study_request' => $user_product_case_study_request, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('user_product_case_study_request/form_actions', array('user_product_case_study_request' => $user_product_case_study_request, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>
<script type='text/javascript'>

    function disableSectorTres() {
        if ($('#user_product_case_study_request_producto_tipo_tres_id option').size() <= 1 && $('#user_product_case_study_request_producto_tipo_dos_id option').size() > 1) {
            $('#user_product_case_study_request_producto_tipo_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona tipo de producto</option>');
            $('#user_product_case_study_request_producto_tipo_tres_id').attr('disabled', 'disabled');
        }
        else
            $('#user_product_case_study_request_producto_tipo_tres_id').removeAttr('disabled');
    }
    
    $(document).ready(function(){
     //   $("ul.error_list:first").remove();  
        $("#user_product_case_study_request_producto_tipo_uno_id").change(function() {
            if ($('#user_product_case_study_request_producto_tipo_uno_id option:selected').val() > 0) {
                reorder_combobox('user_product_case_study_request_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id=' + $('#user_product_case_study_request_producto_tipo_uno_id option:selected').val());
            }
        });

        $("#user_product_case_study_request_producto_tipo_dos_id").change(function() {
            disableSectorTres();
            if ($('#user_product_case_study_request_producto_tipo_dos_id option:selected').val() > 0) {
                reorder_combobox('user_product_case_study_request_producto_tipo_tres_id', 'ids_ordenados_concurso_producto_tipo_tres?producto_tipo_dos_id=' + $('#user_product_case_study_request_producto_tipo_dos_id option:selected').val());
            }
        });
        $('#user_product_case_study_request_producto_tipo_dos_id').change(function() {
            if ($('#user_product_case_study_request_producto_tipo_tres_id option').size() == 1) {
                $('#user_product_case_study_request_producto_tipo_tres_id').attr('disabled', 'disabled');
            }
        });

        $('#user_product_case_study_request_producto_tipo_dos_id').each(function() {
            //alert($('#concurso_producto_tipo_dos_id option:selected').val());
            if ($('#user_product_case_study_request_producto_tipo_dos_id option:selected').val()) {
                if ($('#user_product_case_study_request_producto_tipo_tres_id option').size() == 1) {
                    $('#user_product_case_study_request_producto_tipo_tres_id').attr('disabled', 'disabled');
                }
            }
        });
    });
    // on ready
    $(function(){
        if ($("#user_product_case_study_request_producto_tipo_uno_id").length > 0) {
            reorder_combobox('user_product_case_study_request_producto_tipo_uno_id', 'ids_ordenados_concurso_producto_tipo_uno');
        }
        if ($('#user_product_case_study_request_producto_tipo_uno_id option:selected').val() > 0) {
            reorder_combobox('user_product_case_study_request_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id=' + $('#user_product_case_study_request_producto_tipo_uno_id option:selected').val());
        }
        if ($('#user_product_case_study_request_producto_tipo_dos_id option:selected').val() > 0) {
            reorder_combobox('user_product_case_study_request_producto_tipo_tres_id', 'ids_ordenados_concurso_producto_tipo_tres?producto_tipo_dos_id=' + $('#user_product_case_study_request_producto_tipo_dos_id option:selected').val());
        }
    });
    $('.sf_admin_form_field_description').prepend('<div id="error_max_length" style="display:none;">Has superado el espacio permitido para la descripción del caso de éxito.</div>');
    $('.sf_admin_form_field_summary').prepend('<div id="error_max_length_summary" style="display:none;">Has superado el espacio permitido para el resumen del caso de éxito.</div>');
</script>