<?php use_javascript('https://maps.google.com/maps/api/js?sensor=false'); ?>
<?php use_javascript('/js/sf_widget_gmap_address.js'); ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js'); ?>
<?php use_javascript('reorder_combobox.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css'); ?>

<div id="sf_admin_container">
    <h1>Editar concurso de Empresa/Entidad</h1>
    <?php include_partial('flashes'); ?>
    <div id="sf_admin_header"></div>
    <div id="sf_admin_content">
        <div class="sf_admin_form">
            <form method="post" action="/backend.php/concurso/editEmpresa/id/<?php echo $id ?>" enctype="multipart/form-data">
                <?php //echo $form[$form->getCSRFFieldName()]->render() ?>
                <?php echo $form->renderHiddenFields(); ?>
                <?php echo $form->renderGlobalErrors(); ?>
                <fieldset id="sf_fieldset_none">

                    <?php
                    $fields = array(
                        'name', 'concurso_estado_id', 'user_name', 'concurso_categoria_id', 'created_at', 'destacado', 'featured', 'featured_order'
                    );
                    ?>

                    <?php foreach ($fields as $field): ?>
                        <div class="sf_admin_form_row sf_admin_text sf_admin_form_field_<?php echo $field ?> <?php if ($form[$field]->hasError()): ?>errors<?php endif ?>">
                            <?php echo $form[$field]->renderError() ?>
                            <div>
                                <?php echo $form[$field]->renderLabel() ?>
                                <div class="content">
                                    <?php echo $form[$field]->render() ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>

                    <?php
                    $fields_empresa = array(
                        'empresa_nombre', 'valida', 'road_type_id', 'concurso_address', 'concurso_numero', 'concurso_piso',
                        'concurso_puerta', 'states_id', 'city_id', 'codigopostal', 'persona_contacto', 'email', 'telefono',
                        'empresa_sector_uno_id', 'empresa_sector_dos_id', 'empresa_sector_tres_id', 'lista', 'dividendo', 'divisor', 'lista_cuestionario_id', 'comentario_inicial',
                        'texto_lista_negra', 'googlemap'
                    );
                    ?>

                    <div class="sf_admin_form_row sf_admin_text sf_admin_form_field_empresa">
                        <div>
                            <label for="concurso_empresa">Empresa/Entidad</label>
                            <div class="content">
                                <table>
                                    <tbody>
                                        <?php foreach ($fields_empresa as $field): ?>
                                            <tr>
                                                <th style="white-space: normal; font-weight: normal; color: rgb(102, 102, 102); ">
                                                    <?php echo $form[$field]->renderLabel() ?>
                                                </th>
                                                <td>
                                                    <?php if ($field == 'texto_lista_negra'): ?>
                                                        <ul class="error_list" id="error_max_length_negra" style="display:none;">
                                                            <li>Has superado el espacio permitido para el comentario.</li>
                                                        </ul>
                                                    <?php endif; ?>
                                                    <?php if ($field == 'comentario_inicial'): ?>
                                                        <ul id='error_max_length' class='error_list' style='display:none;'>
                                                            <li>Has superado el espacio permitido para el comentario inicial.</li>
                                                        </ul>
                                                    <?php endif; ?>
                                                    <?php echo $form[$field]->renderError() ?>
                                                    <?php echo $form[$field]->render() ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php
                    $fields_contribucion_inicial = array(
                        'incidencia', 'plan_accion', 'resumen'
                    );
                    ?>

                    <div class="sf_admin_form_row sf_admin_text sf_admin_form_field_contribucion_inicial">
                        <div>
                            <label for="concurso_contribucion_inicial" style="font-weight:bold!important">Contribución inicial</label>
                            <div class="content">
                                <table>
                                    <tbody>
                                        <?php foreach ($fields_contribucion_inicial as $i => $field): ?>

                                            <tr>
                                                <th style="white-space: normal; font-weight: normal; color: rgb(102, 102, 102); "><?php echo $form[$field]->renderLabel() ?></th>
                                                <td>
                                                    <?php if ($field == 'plan_accion'): ?>
                                                        <ul style="display:none" class="error_list" id="Error_max_length_plan_accion">
                                                            <li>Has superado el espacio permitido para tu Plan de acción.</li>
                                                        </ul>
                                                    <?php elseif ($field == 'incidencia'): ?>
                                                        <ul id="Error_max_length_incidencia" class="error_list" style="display: none">
                                                            <li>Has superado el espacio permitido para la descripción de la incidencia.</li>
                                                        </ul>
                                                    <?php elseif ($field == 'resumen'): ?>
                                                        <ul id="Error_max_length_resumen" class="error_list" style="display: none">
                                                            <li>Has superado el espacio permitido para el resumen de tu Plan de acción.</li>
                                                        </ul>
                                                    <?php endif; ?>
                                                    <?php echo $form[$field]->renderError() ?>
                                                    <?php echo $form[$field]->render() ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php
                    $fields_archivo = array(
                        'archivo_1', 'archivo_2', 'archivo_3', 'archivo_4', 'archivo_5'
                    );
                    ?>

                    <?php foreach ($fields_archivo as $field): ?>
                        <div class="sf_admin_form_row sf_admin_text sf_admin_form_field_<?php echo $field ?>">
                            <div>
                                <?php echo $form[$field]->renderLabel() ?>
                                <div class="content">
                                    <?php echo $form[$field]->renderError() ?>
                                    <?php echo $form[$field]->render() ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>

                </fieldset>

                <ul class="sf_admin_actions" style="margin: 10px 10px 10px 0 !important;">
                    <li class="sf_admin_action_list">
                        <a href="/backend.php/concurso">Volver al Listado</a>
                    </li>
                    <li class="sf_admin_action_save">
                        <input type="submit" value="Guardar">
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>


<script language="javascript">
    function ceuta_melilla(f, g) {
        var state2city = new Array();
<?php
foreach (StatesTable::getCiudadesAutonomas() as $city)
    printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
    ?>
        if (state2city[f.val()])
            g.val(state2city[f.val()]).attr("disabled", "disabled");
    }
    $("#concurso_states_id").change(function() {
        ceuta_melilla($(this), $("#concurso_city_id"))
    });
    $("#concurso_states_id").each(function() {
        ceuta_melilla($(this), $("#concurso_city_id"))
    });

    $(document).ready(function() {

        // select Categoría del concurso for From Tipo de concurso
        sortProvinciaList("concurso_states_id");
        $('tr:has(th:contains("Persona contacto")) label').html('Persona de contacto');

        if ($('#concurso_lista option:selected').val() == 'Null') {
            $('tr:has(th:contains("Comentario inicial"))').hide()
            $('tr:has(th:contains("Lista negra: por qué aparece aquí"))').hide()
            $('tr:has(th:contains("Ubicación asociada"))').hide()
            $('tr:has(th:contains("Puntos totales"))').hide()
            $('tr:has(th:contains("Auditorías realizadas"))').hide()
            $('tr:has(th:contains("Cuestionario asociado"))').hide()
        }
        else if ($('#concurso_lista option:selected').val() == 'lb') {
            $('tr:has(th:contains("Comentario inicial"))').show()
            $('tr:has(th:contains("Lista negra: por qué aparece aquí"))').hide()
            $('tr:has(th:contains("Ubicación asociada"))').show()
            $('tr:has(th:contains("Puntos totales"))').show()
            $('tr:has(th:contains("Auditorías realizadas"))').show()
            $('tr:has(th:contains("Cuestionario asociado"))').show()
        }
        else if ($('#concurso_lista option:selected').val() == 'ln') {
            $('tr:has(th:contains("Comentario inicial"))').hide()
            $('tr:has(th:contains("Lista negra: por qué aparece aquí"))').show()
            $('tr:has(th:contains("Ubicación asociada"))').show()
            $('tr:has(th:contains("Puntos totales"))').hide()
            $('tr:has(th:contains("Auditorías realizadas"))').hide()
            $('tr:has(th:contains("Cuestionario asociado"))').hide()
        }

        $('#concurso_lista').change(function() {
            if ($(this).val() == 'Null') {
                $('tr:has(th:contains("Comentario inicial"))').hide()
                $('tr:has(th:contains("Lista negra: por qué aparece aquí"))').hide()
                $('tr:has(th:contains("Ubicación asociada"))').hide()
                $('tr:has(th:contains("Puntos totales"))').hide()
                $('tr:has(th:contains("Auditorías realizadas"))').hide()
                $('tr:has(th:contains("Cuestionario asociado"))').hide()
            }
            else if ($(this).val() == 'lb') {
                $('tr:has(th:contains("Comentario inicial"))').show()
                $('tr:has(th:contains("Lista negra: por qué aparece aquí"))').hide()
                $('tr:has(th:contains("Ubicación asociada"))').show()

                $('tr:has(th:contains("Puntos totales"))').show()
                $('tr:has(th:contains("Auditorías realizadas"))').show()
                $('tr:has(th:contains("Cuestionario asociado"))').show()
            }
            else if ($(this).val() == 'ln') {
                $('tr:has(th:contains("Comentario inicial"))').hide()
                $('tr:has(th:contains("Lista negra: por qué aparece aquí"))').show()
                $('tr:has(th:contains("Ubicación asociada"))').show()
                $('tr:has(th:contains("Puntos totales"))').hide()
                $('tr:has(th:contains("Auditorías realizadas"))').hide()
                $('tr:has(th:contains("Cuestionario asociado"))').hide()
            }
        });
        $(".sf_admin_form_field_created_at label:first").html('Fecha de activación')
        $("#concurso_states_id").change(function() {
            ceuta_melilla($(this), $("#concurso_city_id"))
        });
        $("form").bind("submit", function() {
            $("#concurso_city_id").removeAttr("disabled");
        });
        ceuta_melilla($("#concurso_states_id"), $("#concurso_city_id"));

        $("#concurso_googlemap_lookup").click();

        if ($("#concurso_empresa_sector_uno_id").length > 0) {
            reorder_combobox('concurso_empresa_sector_uno_id', 'ids_ordenados_concurso_empresa_sector_uno');
        }
        if ($('#concurso_empresa_sector_uno_id option:selected').val() > 0) {
            reorder_combobox('concurso_empresa_sector_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?empresa_sector_uno_id=' + $('#concurso_empresa_sector_uno_id option:selected').val());
        }
        if ($('#concurso_empresa_sector_dos_id option:selected').val() > 0) {
            reorder_combobox('concurso_empresa_sector_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?empresa_sector_dos_id=' + $('#concurso_empresa_sector_dos_id option:selected').val());
        }

        //$("#sf_admin_container th").css('white-space', 'normal');
        if (($('#concurso_empresa_sector_dos_id option').size() > 1) && ($('#concurso_empresa_sector_dos_id').val() != '')) {
            if ($('#concurso_empresa_sector_tres_id option').size() <= 1) {
                $('#concurso_empresa_sector_tres_id')
                        .find('option')
                        .remove()
                        .end()
                        .append('<option value="">Selecciona actividad</option>');
                $('#concurso_empresa_sector_tres_id').attr('disabled', 'disabled');
            }
        }
    });

    $("#concurso_empresa_sector_uno_id").change(function() {
        if ($('#concurso_empresa_sector_uno_id option:selected').val() > 0) {
            reorder_combobox('concurso_empresa_sector_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?empresa_sector_uno_id=' + $('#concurso_empresa_sector_uno_id option:selected').val());
        }
    });

    $("#concurso_empresa_sector_dos_id").change(function() {
        if ($('#concurso_empresa_sector_tres_id option').size() <= 1) {
            $('#concurso_empresa_sector_tres_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Selecciona actividad</option>');
            $('#concurso_empresa_sector_tres_id').attr('disabled', 'disabled');
        }
        else {
            $('#concurso_empresa_sector_tres_id').removeAttr('disabled');
            if ($('#concurso_empresa_sector_dos_id option:selected').val() > 0) {
                reorder_combobox('concurso_empresa_sector_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?empresa_sector_dos_id=' + $('#concurso_empresa_sector_dos_id option:selected').val());
            }
        }
    });

    $('#concurso_googlemap_address').blur(function() {
        $("#concurso_googlemap_lookup").click();
    });

    $('#concurso_empresa_sector_dos_id').change(function() {
        if ($('#concurso_empresa_sector_tres_id option').size() == 1) {
            $('#concurso_empresa_sector_tres_id').attr('disabled', 'disabled');
        }
    });

    $('#concurso_empresa_sector_dos_id').each(function() {
        if ($('#concurso_empresa_sector_dos_id option:selected').val()) {
            if ($('#concurso_empresa_sector_tres_id option').size() == 1) {
                $('#concurso_empresa_sector_tres_id').attr('disabled', 'disabled');
            }
        }
    });
</script>