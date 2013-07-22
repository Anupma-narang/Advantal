<?php use_javascript('jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/JqueryAutocomplete.css') ?>
<div id="sf_admin_container">
    <h1>Nuevo concurso de Producto</h1>
    <?php include_partial('flashes') ?>
    <div id="sf_admin_header"></div>
    <div id="sf_admin_content">
        <div class="sf_admin_form">
            <form method="post" action="/backend.php/concurso/newProducto" enctype="multipart/form-data">
                <?php //echo $form[$form->getCSRFFieldName()]->render() ?>
                <?php echo $form->renderHiddenFields(); ?>
                <fieldset id="sf_fieldset_none">

                    <?php
                    $fields = array(
                        'name', 'concurso_estado_id', 'user_name', 'concurso_categoria_id', 'producto_nombre', 'marca', 'modelo', 'producto_tipo_uno_id', 'producto_tipo_dos_id', 'producto_tipo_tres_id', 'destacado', 'featured', 'featured_order'
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
                                        <?php foreach ($fields_contribucion_inicial as $field): ?>
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
                </fieldset>

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
                    <li class="sf_admin_action_save_and_add"><input type="submit" name="_save_and_add" value="Guardar y crear otro"></li>
                </ul>
            </form>
        </div>
    </div>
</div>

<script language="javascript">
    $(document).ready(function() {
        $("form").bind("submit", function() {
            $("#concurso_city_id").removeAttr("disabled");
        });
        $("#sf_admin_container label").css('width', '11em');

        $('#concurso_producto_tipo_dos_id').change(function() {
            if ($('#concurso_producto_tipo_tres_id option').size() == 1) {
                $('#concurso_producto_tipo_tres_id').attr('disabled', 'disabled');
            }
        });

        $('#concurso_producto_tipo_dos_id').each(function() {
            //alert($('#concurso_producto_tipo_dos_id option:selected').val());
            if ($('#concurso_producto_tipo_dos_id option:selected').val()) {
                if ($('#concurso_producto_tipo_tres_id option').size() == 1) {
                    $('#concurso_producto_tipo_tres_id').attr('disabled', 'disabled');
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
            if($("#concurso_marca").val().length <= 4){
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