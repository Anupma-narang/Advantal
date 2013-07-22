<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
    <?php echo form_tag_for($form, '@profesionales_pendientes', array('id' => 'frmProfesional')) ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('profesionales_pendientes/form_fieldset', array('profesional' => $profesional, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('profesionales_pendientes/form_actions', array('profesional' => $profesional, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>


<script>

    $("#profesional_profesional_tipo_dos_id").change(function() {
        if ($('#profesional_profesional_tipo_tres_id option').size() <= 1) {
            $('#profesional_profesional_tipo_tres_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Selecciona actividad</option>');
            $('#profesional_profesional_tipo_tres_id').attr('disabled', 'disabled');
        }
        else {
            $('#profesional_profesional_tipo_tres_id').removeAttr('disabled');
            if ($('#profesional_profesional_tipo_dos_id option:selected').val() > 0) {
                reorder_combobox('profesional_profesional_tipo_tres_id', 'ids_ordenados_profesional_profesional_tipo_tres?profesional_tipo_dos_id=' + $('#profesional_profesional_tipo_dos_id option:selected').val());
            }
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
    $(document).ready(function() {
        $("#profesional_states_id").change(function() {
            ceuta_melilla($(this), $("#profesional_city_id"))
        });
        $("#frmProfesional").bind("submit", function() {
            $("#profesional_city_id").removeAttr("disabled");
        });
        ceuta_melilla($("#profesional_states_id"), $("#profesional_city_id"));


        if ($('#profesional_profesional_tipo_tres_id option').size() <= 1) {
            $('#profesional_profesional_tipo_tres_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Selecciona actividad</option>');
            $('#profesional_profesional_tipo_tres_id').attr('disabled', 'disabled');
        }

        $('.sf_admin_form_field_incidencia').prepend('<ul id="Error_max_length_incidencia" class="error_list" style="display:none;"><li>Has superado el espacio permitido para tu recomendación.</li></ul>');
        $('.sf_admin_form_field_active_reason').prepend('<ul id="Error_max_length_active_reason" class="error_list" style="display:none;"><li>Has superado el espacio permitido para tu Indicadores de excelencia.</li></ul>');
    });
</script>
