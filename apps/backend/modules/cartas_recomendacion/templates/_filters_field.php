<?php if ($field->isPartial()): ?>
    <?php include_partial('cartas_recomendacion/' . $name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
    <?php include_component('cartas_recomendacion', $name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
    <tr class="<?php echo $class ?>">
        <td>
            <?php echo $form[$name]->renderLabel($label) ?>
        </td>
        <td>
            <?php echo $form[$name]->renderError() ?>

            <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>

            <?php if ($help || $help = $form[$name]->renderHelp()): ?>
                <div class="help"><?php echo __($help, array(), 'messages') ?></div>
            <?php endif; ?>
        </td>
    </tr>
<?php endif; ?>


<script>

    $("#profesional_filters_profesional_tipo_dos_id").change(function() {
        if ($('#profesional_filters_profesional_tipo_tres_id option').size() <= 1) {
            $('#profesional_filters_profesional_tipo_tres_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Selecciona actividad</option>');
            $('#profesional_filters_profesional_tipo_tres_id').attr('disabled', 'disabled');
        }
        else {
            $('#profesional_filters_profesional_tipo_tres_id').removeAttr('disabled');
            if ($('#profesional_filters_profesional_tipo_dos_id option:selected').val() > 0) {
                reorder_combobox('profesional_filters_profesional_tipo_tres_id', 'ids_ordenados_profesional_profesional_tipo_tres?profesional_tipo_dos_id=' + $('#profesional_profesional_tipo_dos_id option:selected').val());
            }
        }
    });

    function ceuta_melilla(f, g) {
        var state2city = new Array();<?php foreach (StatesTable::getCiudadesAutonomas() as $city)
    printf('state2city[%d]=%d;', $city['states_id'], $city['id']) ?>
        if (state2city[f.val()])
            g.val(state2city[f.val()]).attr("disabled", "disabled");
    }
    $(document).ready(function() {
        $("#profesional_letter_filters_states_id").change(function() {
            ceuta_melilla($(this), $("#profesional_letter_filters_city_id"))
        });
        /*$("#frmFilterRecomendacion").bind("submit",function(){$("#profesional_letter_filters_city_id").removeAttr("disabled");});*/
        ceuta_melilla($("#profesional_letter_filters_states_id"), $("#profesional_letter_filters_city_id"));
    });
</script>