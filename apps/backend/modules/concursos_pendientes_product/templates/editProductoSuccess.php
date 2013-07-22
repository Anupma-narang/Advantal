<?php use_helper('jQuery'); ?>
<?php use_javascript('reorder_combobox.js') ?>
<?php use_javascript('https://maps.google.com/maps/api/js?sensor=false'); ?>
<?php use_javascript('/js/sf_widget_gmap_address.js'); ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js'); ?>
<?php use_javascript('reorder_combobox.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css'); ?>
<?php use_javascript('edit_choice.js') ?>
<?php use_javascript('fancybox/jquery.fancybox.js') ?>
<div id="sf_admin_container">
    <h1>Editar concurso de Producto</h1>
    <div id="sf_admin_header"></div>
    <div id="sf_admin_content">
        <div class="sf_admin_form">
            <form method="post" action="/backend.php/concursos_pendientes_product/editProducto/id/<?php echo $id ?>" enctype="multipart/form-data">
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
                    $fields_producto = array(
                        'producto_nombre', 'valida', 'marca', 'modelo', 'persona_contacto', 'email', 'telefono',
                        'producto_tipo_uno_id', 'producto_tipo_dos_id', 'producto_tipo_tres_id', 'lista', 'dividendo', 'divisor', 'lista_cuestionario_id', 'comentario_inicial', 'texto_lista_negra'
                    );
                    ?>

                    <div class="sf_admin_form_row sf_admin_text sf_admin_form_field_producto">
                        <div>
                            <label for="concurso_producto">Producto</label>
                            <div class="content">
                                <table>
                                    <tbody>
                                        <?php foreach ($fields_producto as $field): ?>
                                            <tr>
                                                <th style="white-space: normal; font-weight: normal; color: rgb(102, 102, 102); "><?php echo $form[$field]->renderLabel() ?></th>
                                                <td>
                                                    <?php if ($field == 'texto_lista_negra'): ?>
                                                        <ul class="error_list" id="error_max_length_negra" style="display:none;">
                                                            <li>Has superado el espacio permitido para el comentario.</li>
                                                        </ul>
                                                    <?php endif; ?>
                                                    <?php if ($field == 'comentario_inicial'): ?>
                                                        <ul id='error_max_length' class='error_list' style='display:none;'><li>Has superado el espacio permitido para el comentario inicial.</li></ul>
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
                            <label for="concurso_contribucion_inicial" style="font-weight: bold!important">Contribución inicial</label>
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
                                        <?php endforeach ?>
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
                        <a href="/backend.php/concursos_pendientes_product">Volver al Listado</a>
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
    $(document).ready(function() {
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
        //$("#sf_admin_container th").css('white-space', 'normal');
        $(".sf_admin_form_field_created_at label:first").html('Fecha de activación')
        if ($("#concurso_producto_tipo_uno_id").length > 0) {
            reorder_combobox('concurso_producto_tipo_uno_id', 'ids_ordenados_concurso_producto_tipo_uno');
        }
        if ($('#concurso_producto_tipo_uno_id option:selected').val() > 0) {
            reorder_combobox('concurso_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id=' + $('#concurso_producto_tipo_uno_id option:selected').val());
        }
        if ($('#concurso_producto_tipo_dos_id option:selected').val() > 0) {
            reorder_combobox('concurso_producto_tipo_tres_id', 'ids_ordenados_concurso_producto_tipo_tres?producto_tipo_dos_id=' + $('#concurso_producto_tipo_dos_id option:selected').val());
        }

        if (($('#concurso_producto_tipo_dos_id option').size() > 1) && ($('#concurso_producto_tipo_dos_id').val() != '')) {
            if ($('#concurso_producto_tipo_tres_id option').size() <= 1) {
                $('#concurso_producto_tipo_tres_id')
                        .find('option')
                        .remove()
                        .end()
                        .append('<option value="">Selecciona subsector</option>');
                $('#concurso_producto_tipo_tres_id').attr('disabled', 'disabled');
            }
        }


        $("#concurso_producto_tipo_uno_id").change(function() {
            if ($('#concurso_producto_tipo_uno_id option:selected').val() > 0) {
                reorder_combobox('concurso_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id=' + $(' #concurso_producto_tipo_uno_id option:selected').val());
            }
        });

        $("#concurso_producto_tipo_dos_id").change(function() {
            if ($('#concurso_producto_tipo_tres_id option').size() <= 1) {
                $('#concurso_producto_tipo_tres_id')
                        .find('option')
                        .remove()
                        .end()
                        .append('<option value="">Selecciona subsector</option>');
                $('#concurso_producto_tipo_tres_id').attr('disabled', 'di sabled');
            }
            else {
                $('#concurso_producto_tipo_tres_id').removeAttr('disabled');
                if ($('#concurso_producto_tipo_dos_id option:selected').val() > 0) {
                    reorder_combobox('concurso_producto_tipo_tres_id', 'ids_ordenados_concurso_producto_tipo_tres?producto_tipo_dos_id=' + $(' #concurso_producto_tipo_dos_id option:selected').val());
                }
            }
        });

        $("#concurso_producto_nombre").autocomplete("<?php echo url_for('/autocompleteproducto') ?>", jQuery.extend({minLength: 4}, {
            minChars: 4,
            dataType: 'json',
            parse: function(data) {
                var parsed = [];
                for (key in data)
                    parsed[parsed.length] = {data: [data[key], key], value: data[key], result: data[key]};
                return parsed;
            }
        })).result(function(event, data) {
            get_producto(data[0]);
        });

        $("#concurso_producto_nombre").bind('keyup', function() {
            setTimeout(function() {
                if ($("#concurso_producto_nombre").val() != '') {
                    get_producto($("#concurso_producto_nombre").val());
                }
            }, 100);
        });

        var get_producto = function(nombre) {
            $.getJSON('/ajax_get/producto_by_nombre?nombre=' + nombre);
        };

        var get_producto_modelo = function(marca) {
            if (marca.length >= 4) {
                $.getJSON('/ajax_get/producto_modelo_by_marca?marca=' + marca,
                        function(data) {
                            if (data.retorno == 'true') {
                                $('#concurso_modelo').val(data.modelo);
                            }
                        });
            }
        };

        $("#concurso_marca").autocomplete("<?php echo url_for('/complete') ?>",
                jQuery.extend({minChars: 4}, {
            dataType: 'json',
            minChars: 4,
            parse: function(data) {
                var parsed = [];
                for (key in data) {
                    parsed[parsed.length] = {data: [data[key], key], value: data[key], result: data[key]};
                }
                return parsed;
            }
        }, {})).result(function(event, data) {
            get_producto_modelo(data[0]);
        });

        $("#concurso_marca").bind('keyup', function() {
            if ($("#concurso_marca").val().length <= 4) {
                $('#concurso_modelo').val("");
            }
        });

        /*$("#concurso_marca").bind('keyup', function() {
         setTimeout(function() {
         if ($("#concurso_marca").val() != '') {
         if ($("#concurso_marca").length >= 4) {
         get_producto_modelo($("#concurso_marca").val());
         }
         }
         }, 100);
         });*/
        // For modelo autocomplete


        $("#concurso_modelo").autocomplete("<?php echo url_for('/autocompletemodel') ?>",
                jQuery.extend({minChars: 4}, {
            dataType: 'json',
            minChars: 4,
            parse: function(data) {
                var parsed = [];
                for (key in data) {
                    parsed[parsed.length] = {data: [data[key], key], value: data[key], result: data[key]};
                }
                return parsed;
            }
        }, {})).result(function(event, data) {
            get_producto_modelo(data[0]);
        });

        $("#concurso_modelo").bind('keyup', function() {
            setTimeout(function() {
                if ($("#concurso_modelo").val() != '') {
                    get_producto_modelo($("#concurso_modelo").val());
                }
            }, 100);
        });
    });
</script>