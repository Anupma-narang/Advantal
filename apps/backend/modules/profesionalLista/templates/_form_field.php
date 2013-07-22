<?php if ($field->isPartial()): ?>
    <?php include_partial('profesionalLista/' . $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
    <?php include_component('profesionalLista', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
    <div class="<?php echo $class ?><?php $form[$name]->hasError() and print ' errors' ?>">
        <?php echo $form[$name]->renderError() ?>

        <?php /* if ($name == 'incidencia'): ?>
            <ul id="Error_max_length_incidencia" class="error_list" style="display:none">
                <li>Has superado el espacio permitido para tu recomendación.</li>
            </ul>
        <?php endif; */?>
        <?php if ($name == 'active_reason'): ?>
            <ul id="error_max_length" class="error_list" style="display:none">
                <li>Has superado el espacio permitido para los Indicadores de excelencia.</li>
            </ul>
        <?php endif; ?>

        <div>
            <?php echo $form[$name]->renderLabel($label) ?>

            <div class="content"><?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?></div>

            <?php if ($help): ?>
                <div class="help"><?php echo __($help, array(), 'messages') ?></div>
            <?php elseif ($help = $form[$name]->renderHelp()): ?>
                <div class="help"><?php echo $help ?></div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>


<script>

    function ceuta_melilla(f,g){
        var state2city = new Array();<?php
foreach (StatesTable::getCiudadesAutonomas() as $city)
    printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
    ?>
            if(state2city[f.val()])
                g.val(state2city[f.val()]).attr("disabled","disabled");
        }
        $(document).ready(function() {
            $("#profesional_states_id").change(function(){ ceuta_melilla($(this),$("#profesional_city_id")) });
            $("#frmProfesional").bind("submit",function(){$("#profesional_city_id").removeAttr("disabled");});
            ceuta_melilla($("#profesional_states_id"),$("#profesional_city_id"));});

</script>