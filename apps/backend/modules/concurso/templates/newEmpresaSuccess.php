<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js'); ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css'); ?>
<div id="sf_admin_container">
    <h1>Nuevo concurso de Empresa/Entidad</h1>    
    <?php include_partial('flashes') ?>
    <div id="sf_admin_header"></div>
    <div id="sf_admin_content">
        <div class="sf_admin_form">
            <form method="post" action="/backend.php/concurso/newEmpresa" enctype="multipart/form-data" id="newConcursoFormEmpresa">
                <?php //echo $form[$form->getCSRFFieldName()]->render() ?>
                <?php echo $form->renderHiddenFields(); ?>

                <fieldset id="sf_fieldset_none">

                    <?php
                    $fields = array(
                        'name', 'concurso_estado_id', 'user_name', 'concurso_categoria_id', 'empresa_nombre', 'empresa_sector_uno_id', 'empresa_sector_dos_id', 'empresa_sector_tres_id', 'road_type_id',
                        'concurso_address', 'concurso_numero', 'concurso_piso', 'concurso_puerta', 'states_id', 'city_id', 'codigopostal', 'destacado', 'featured', 'featured_order'
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

                    <li class="sf_admin_action_save_and_add"><input type="submit" name="_save_and_add" value="Guardar y crear otro"></li>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>

<script language="javascript">
    $(document).ready(function() {
        sortProvinciaList("concurso_states_id");

        $("form").bind("submit", function() {
            $("#concurso_city_id").removeAttr("disabled");
        });
        $("#concurso_empresa_nombre").autocomplete("<?php echo url_for('/autocomplete') ?>", jQuery.extend({minLength: 4}, {
            minChars: 4,
            dataType: 'json',
            parse: function(data) {
                var parsed = [];
                for (key in data)
                    parsed[parsed.length] = {data: [data[key], key], value: data[key], result: data[key]};
                return parsed;
            }
        })).result(function(event, data) {
            get_empresa(data[0]);
        });

        $("#concurso_empresa_nombre").bind('keyup', function() {
            setTimeout(function() {
                if ($("#concurso_empresa_nombre").val() != '') {
                    get_empresa($("#concurso_empresa_nombre").val());
                }
            }, 100);
        });

        var selected_val = Array('', '', '');
        var get_empresa = function(nombre) {
            if (nombre == '')
                return;
            $.getJSON('/ajax_get/empresa_by_nombre?nombre=' + nombre);
        };
    });
    function ceuta_melilla(f, g) {
        var state2city = new Array();<?php
                foreach (StatesTable::getCiudadesAutonomas() as $city)
                    printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
                    ?>

        if (state2city[f.val()])
            g.val(state2city[f.val()]).attr("disabled", "disabled");
    }
    $("#concurso_states_id").change(function() {
        ceuta_melilla($(this), $("#concurso_city_id"))
    });
    $("#newConcursoFormEmpresa").bind("submit", function() {
        $("#concurso_city_id").removeAttr("disabled");
    });
    ceuta_melilla($("#concurso_states_id"), $("#concurso_city_id"));

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