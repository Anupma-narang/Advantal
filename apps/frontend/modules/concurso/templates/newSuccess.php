<?php use_stylesheet('forms.css') ?>
<?php use_stylesheet('caja.css') ?>
<?php use_javascript('ckeditor/ckeditor.js') ?>
<?php use_javascript('reorder_combobox.js') ?>

<div id="content_concursos_nuevo">
    <div id="content_breadcroum">
        <?php echo link_to("Inicio", "home/index") ?>
        >>
        <?php echo link_to('Concursos', 'concurso/index') ?>
        >>
        <?php echo $tipo == 'empresa' ? link_to('Empresa/Entidad', 'concurso/index?tipo=empresa') : link_to('Producto', 'concurso/index?tipo=producto') ?>
        >>
        <?php echo link_to(__('Crea concurso'), 'concurso/new?tipo=' . $tipo) ?>
    </div>

    <?php
    $concurso_url = 'concurso/index';
    $concurso_url .= '?tipo=' . $sf_user->getAttribute('concurso_estado_tipo', 'empresa');
    $concurso_url .= '&page=' . $sf_user->getAttribute('concurso_estado_page', 1);
    ?>
    <div style="float: left; margin: 10px;"><?php echo link_to('vuelve a concursos', $concurso_url) ?></div>

    <div id="concurso_crear">
        <div id="concurso_crear_texto">Crea concurso</div>
    </div>
    <div id="content_concurso_activos_boton">
        <div id="boton_noactivo">
            <span class="concurso_link_no"> <?php echo link_to("Empresa / Entidad", "concurso/new?tipo=empresa", array("class" => $tipo == "empresa" ? "active" : "")) ?>
            </span>
        </div>
        <div id="boton_noactivo">
            <span class="concurso_link_no"> <?php echo link_to("Producto", "concurso/new?tipo=producto", array("class" => $tipo == "producto" ? "active" : "")) ?>
            </span>
        </div>
    </div>

    <?php include_partial('concurso_form', array('form' => $form, 'tipo' => $tipo, 'parent_id' => $id)) ?>
</div>
<script>
    var selected_val = Array('', '', '');
    var get_empresa = function(nombre)

    {
        if (nombre == '')
            return;

        $.getJSON('/ajax_get/empresa_by_nombre?nombre=' + nombre,
                function(data) {
                    if (data.retorno == 'true') {
                        $('#concurso_empresa_sector_uno_id option[value=' + data.sector_1 + ']').attr("selected", true);

                        if (data.sector_2_id != null) {
                            $('option', $('#concurso_empresa_sector_dos_id')).remove();
                            $.each(data.sector_2, function(index, value) {
                                $('#concurso_empresa_sector_dos_id').append('<option value="' + index + '">' + value + '</option>');
                                $('#concurso_empresa_sector_dos_id option[value=' + data.sector_2_id + ']').attr("selected", true);
                            });
                        }
                        if (data.sector_3_id != null) {
                            $('option', $('#concurso_empresa_sector_tres_id')).remove();
                            $.each(data.sector_3, function(index, value) {
                                $('#concurso_empresa_sector_tres_id').append('<option value="' + index + '">' + value + '</option>');
                                $('#concurso_empresa_sector_tres_id option[value=' + data.sector_3_id + ']').attr("selected", true);
                                $('#concurso_empresa_sector_tres_id').removeAttr("disabled");
                            });
                        } else {
                            $('#concurso_empresa_sector_tres_id').attr('disabled', 'disabled');
                        }

                        setFocus('concurso_empresa_sector_uno_id', 1);
                        setFocus('concurso_empresa_sector_dos_id', 2);
                        setFocus('concurso_empresa_sector_tres_id', 3);

                    }
                    else {
                        unsetFocus('concurso_empresa_sector_uno_id', 1);
                        unsetFocus('concurso_empresa_sector_dos_id', 2);
                        unsetFocus('concurso_empresa_sector_tres_id', 3);
                        /*$('#concurso_empresa_sector_uno_id').removeAttr('onfocus');

                         $('#concurso_empresa_sector_uno_id option[value=""]').attr("selected",true);

                         $('option', $('#concurso_empresa_sector_dos_id')).remove();
                         $('#concurso_empresa_sector_dos_id').append('<option value="">Selecciona subsector</option>');
                         $('#concurso_empresa_sector_dos_id option[value=""]').attr("selected",true);

                         $('option', $('#concurso_empresa_sector_tres_id')).remove();
                         $('#concurso_empresa_sector_tres_id').append('<option value="">Selecciona actividad</option>');
                         $('#concurso_empresa_sector_tres_id option[value=""]').attr("selected",true);


                         /*$('#concurso_empresa_sector_uno_id').removeAttr('disabled');
                         $('#concurso_empresa_sector_dos_id').removeAttr('disabled');
                         $('#concurso_empresa_sector_tres_id').removeAttr('disabled');*/
                    }
                });
    };

    var get_producto = function(nombre)
    {
        $.getJSON('/ajax_get/producto_by_nombre?nombre=' + nombre,
                function(data) {
                    if (data.retorno == 'true') {
                        $('#concurso_producto_tipo_uno_id option[value=' + data.tipo_1 + ']').attr("selected", true);

                        if (data.tipo_2_id != null) {
                            $('option', $('#concurso_producto_tipo_dos_id')).remove();
                            $.each(data.tipo_2, function(index, value) {
                                $('#concurso_producto_tipo_dos_id').append('<option value="' + index + '">' + value + '</option>');
                                $('#concurso_producto_tipo_dos_id option[value=' + data.tipo_2_id + ']').attr("selected", true);
                            });

                        }
                        if (data.tipo_3_id != null) {
                            $('option', $('#concurso_producto_tipo_tres_id')).remove();
                            $.each(data.tipo_3, function(index, value) {
                                $('#concurso_producto_tipo_tres_id').append('<option value="' + index + '">' + value + '</option>');
                                $('#concurso_producto_tipo_tres_id option[value=' + data.tipo_3_id + ']').attr("selected", true);
                            });
                        } else {
                            $('#concurso_producto_tipo_tres_id').attr('disabled', 'disabled');
                        }
                        setFocus('concurso_producto_tipo_uno_id', 1);
                        setFocus('concurso_producto_tipo_dos_id', 2);
                        setFocus('concurso_producto_tipo_tres_id', 3);

                    }
                    else {
                        $('#concurso_producto_tipo_uno_id option[value=""]').attr("selected", true);

                        $('option', $('#concurso_producto_tipo_dos_id')).remove();
                        $('#concurso_producto_tipo_dos_id').append('<option value="">Selecciona subsector</option>');
                        $('#concurso_producto_tipo_dos_id option[value=""]').attr("selected", true);

                        $('option', $('#concurso_producto_tipo_tres_id')).remove();
                        $('#concurso_producto_tipo_tres_id').append('<option value="">Selecciona tipo</option>');
                        $('#concurso_producto_tipo_tres_id option[value=""]').attr("selected", true);

                        unsetFocus('concurso_producto_tipo_uno_id', 1);
                        unsetFocus('concurso_producto_tipo_dos_id', 2);
                        unsetFocus('concurso_producto_tipo_tres_id', 3);
                    }
                });
    };

    var get_producto_modelo = function(marca)
    {
        $.getJSON('/ajax_get/producto_modelo_by_marca?marca=' + marca,
                function(data) {
                    if (data.retorno == 'true') {
                        $('#concurso_modelo').val(data.modelo);
                    }
                });
    };

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
    //$("#concurso_empresa_nombre").bind('blur',function(){setTimeout(function(){get_empresa($("#concurso_empresa_nombre").val())},100)});
    $("#concurso_empresa_nombre").bind('keyup', function() {
        setTimeout(function() {
            if ($("#concurso_empresa_nombre").val() != '') {
                get_empresa($("#concurso_empresa_nombre").val());
            } else {
                $('#concurso_empresa_nombre').val('');
                $('#concurso_empresa_sector_uno_id option[value=""]').attr("selected", true);

                $('option', $('#concurso_empresa_sector_dos_id')).remove();
                $('#concurso_empresa_sector_dos_id').append('<option value="">Selecciona subsector</option>');
                $('#concurso_empresa_sector_dos_id option[value=""]').attr("selected", true);

                $('option', $('#concurso_empresa_sector_tres_id')).remove();
                $('#concurso_empresa_sector_tres_id').append('<option value="">Selecciona actividad</option>');
                $('#concurso_empresa_sector_tres_id option[value=""]').attr("selected", true);
            }
        }, 100);
    });




    $("#concurso_producto_nombre").autocomplete("<?php echo url_for('/complete') ?>",
            jQuery.extend({minChars: 4}, {
        dataType: 'json',
        minChars: 4,
        parse: function(data) {
            var parsed = [];
            for (key in data) {
                parsed[parsed.length] = {data: [data[key], key], value: data[key], result: data[key]};
            }
            return parsed;
        },
    }, {})).result(function(event, data) {
        get_producto_modelo(data[0]);
    });
    $("#concurso_producto_nombre").bind('keyup', function() {
        setTimeout(function() {
            if ($("#concurso_producto_nombre").val() != '') {
                get_producto_modelo($("#concurso_producto_nombre").val());
            } else {
                $('#concurso_modelo').val('');
            }
        }, 100);
    });

    $("#concurso_producto").autocomplete("<?php echo url_for('concurso/completeNombreProducto') ?>",
            jQuery.extend({minChars: 4}, {
        minChars: 4,
        dataType: 'json',
        parse: function(data) {
            var parsed = [];
            for (key in data) {
                parsed[parsed.length] = {data: [data[key], key], value: data[key], result: data[key]};
            }
            return parsed;
        },
    }, {})).result(function(event, data) {
        get_producto(data[0]);
    });
    $("#concurso_producto").bind('keyup', function() {
        setTimeout(function() {
            if ($("#concurso_producto").val() != '') {
                get_producto($("#concurso_producto").val());
            } else {
                $('#concurso_producto_tipo_uno_id option[value=""]').attr("selected", true);

                $('option', $('#concurso_producto_tipo_dos_id')).remove();
                $('#concurso_producto_tipo_dos_id').append('<option value="">Selecciona subsector</option>');
                $('#concurso_producto_tipo_dos_id option[value=""]').attr("selected", true);

                $('option', $('#concurso_producto_tipo_tres_id')).remove();
                $('#concurso_producto_tipo_tres_id').append('<option value="">Selecciona tipo</option>');
                $('#concurso_producto_tipo_tres_id option[value=""]').attr("selected", true);
            }
        }, 100);
    });

    $("#concurso_empresa_sector_uno_id").change(function() {
        if ($('#concurso_empresa_sector_uno_id option:selected').val() > 0) {
            reorder_combobox('concurso_empresa_sector_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?empresa_sector_uno_id=' + $('#concurso_empresa_sector_uno_id option:selected').val());
        }
    });

    //desactivamos el combo tres si no tiene valores
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

    $("#concurso_producto_tipo_uno_id").change(function() {
        if ($('#concurso_producto_tipo_uno_id option:selected').val() > 0) {
            reorder_combobox('concurso_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id=' + $('#concurso_producto_tipo_uno_id option:selected').val());
        }
    });

    $("#concurso_producto_tipo_dos_id").change(function() {
        if ($('#concurso_producto_tipo_tres_id option').size() <= 1) {
            $('#concurso_producto_tipo_tres_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Selecciona subsector</option>');
            $('#concurso_producto_tipo_tres_id').attr('disabled', 'disabled');
        }
        else {
            $('#concurso_producto_tipo_tres_id').removeAttr('disabled');
            if ($('#concurso_producto_tipo_dos_id option:selected').val() > 0) {
                reorder_combobox('concurso_producto_tipo_tres_id', 'ids_ordenados_concurso_producto_tipo_tres?producto_tipo_dos_id=' + $('#concurso_producto_tipo_dos_id option:selected').val());
            }
        }
    });


    function ceuta_melilla(f, g) {
        var state2city = new Array();<?php
    foreach (StatesTable::getCiudadesAutonomas() as $city)
        printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
        ?>
        console.log(state2city);
        console.log(f);
        if (state2city[f.val()])
            g.val(state2city[f.val()]).attr("disabled", "disabled");
    }

<?php if ($id): ?>
    <?php if ($tipo == 'empresa'): ?>
        <?php if ($empresa = Doctrine::getTable('Empresa')->createQuery()->where('id=?', $id)->fetchOne()): ?>
            <?php
            $values_empresa = array();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $values_empresa['empresa_nombre'] = $current_values['empresa_nombre'] != '' ? $current_values['empresa_nombre'] : '';
                $values_empresa['empresa_sector_uno_id'] = $current_values['empresa_sector_uno_id'] > 0 ? $current_values['empresa_sector_uno_id'] : '';
                $values_empresa['empresa_sector_dos_id'] = $current_values['empresa_sector_dos_id'] > 0 ? $current_values['empresa_sector_dos_id'] : '';
                if ($values_empresa['empresa_sector_dos_id'] > 0) {
                    $sector_dos = Doctrine::getTable('EmpresaSectorDos')->createQuery()->where('id=?', $values_empresa['empresa_sector_dos_id'])->fetchOne();
                    $values_empresa['empresa_sector_dos_name'] = $sector_dos->getName();
                } else {
                    $values_empresa['empresa_sector_dos_name'] = '';
                }
                $values_empresa['empresa_sector_tres_id'] = $current_values['empresa_sector_tres_id'] > 0 ? $current_values['empresa_sector_tres_id'] : '';
                if ($values_empresa['empresa_sector_tres_id'] > 0) {
                    $sector_tres = Doctrine::getTable('EmpresaSectorTres')->createQuery()->where('id=?', $values_empresa['empresa_sector_tres_id'])->fetchOne();
                    $values_empresa['empresa_sector_tres_name'] = $sector_tres->getName();
                } else {
                    $values_empresa['empresa_sector_tres_name'] = '';
                }
            } else {
                $values_empresa['empresa_nombre'] = $empresa->getName();
                $values_empresa['empresa_sector_uno_id'] = $empresa->getEmpresaSectorUnoId();
                $values_empresa['empresa_sector_dos_id'] = $empresa->getEmpresaSectorDosId();
                $values_empresa['empresa_sector_dos_name'] = $empresa->getEmpresaSectorDos()->getName();
                $values_empresa['empresa_sector_tres_id'] = $empresa->getEmpresaSectorTresId();
                $values_empresa['empresa_sector_tres_name'] = $empresa->getEmpresaSectorTres()->getName();
            }
            ?>
                $(document).ready(function() {
                    setTimeout(function() {
                        $('#concurso_empresa_nombre').val('<?php echo $values_empresa['empresa_nombre'] ?>');
                    }, 50);
                    $('#concurso_empresa_sector_uno_id').val('<?php echo $values_empresa['empresa_sector_uno_id'] ?>');
            <?php if ($values_empresa['empresa_sector_dos_id'] == $empresa->getEmpresaSectorDosId()): ?>
                        $('option', $('#concurso_empresa_sector_dos_id')).remove();
                        $('#concurso_empresa_sector_dos_id').append(new Option('<?php echo $values_empresa['empresa_sector_dos_name'] ?>', <?php echo $values_empresa['empresa_sector_dos_id'] ?>, true, true));
            <?php endif ?>
            <?php if ($values_empresa['empresa_sector_tres_id'] == $empresa->getEmpresaSectorTresId()): ?>
                        $('option', $('#concurso_empresa_sector_tres_id')).remove();
                <?php if ($values_empresa['empresa_sector_tres_name']): ?>
                            $('#concurso_empresa_sector_tres_id').append(new Option('<?php echo $values_empresa['empresa_sector_tres_name'] ?>', <?php echo $values_empresa['empresa_sector_tres_id'] ?>, true, true));
                <?php else: ?>
                            $('#concurso_empresa_sector_tres_id')
                                    .find('option')
                                    .remove()
                                    .end()
                                    .append('<option value="">Selecciona actividad</option>');
                            $('#concurso_empresa_sector_tres_id').attr('disabled', 'disabled');
                <?php endif ?>
            <?php elseif (empty($values_empresa['empresa_sector_tres_id'])): ?>
                        if ($('#concurso_empresa_sector_tres_id option').size() == 1 && $('#concurso_empresa_sector_dos_id').val() != '') {
                            $('#concurso_empresa_sector_tres_id').attr('disabled', 'disabled');
                        }
            <?php endif ?>
                });
        <?php endif; ?>
    <?php elseif ($tipo == 'producto'): ?>
        <?php if ($producto = Doctrine::getTable('Producto')->createQuery()->where('id=?', $id)->fetchOne()): ?>
            <?php
            $values_producto = array();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $values_producto['producto'] = $current_values['producto'] != '' ? $current_values['producto'] : '';
                $values_producto['producto_nombre'] = $current_values['producto_nombre'] != '' ? $current_values['producto_nombre'] : '';
                $values_producto['modelo'] = $current_values['modelo'] != '' ? $current_values['modelo'] : '';
                $values_producto['producto_tipo_uno_id'] = $current_values['producto_tipo_uno_id'] > 0 ? $current_values['producto_tipo_uno_id'] : '';
                $values_producto['producto_tipo_dos_id'] = $current_values['producto_tipo_dos_id'] > 0 ? $current_values['producto_tipo_dos_id'] : '';
                if ($values_producto['producto_tipo_dos_id'] > 0) {
                    $tipo_dos = Doctrine::getTable('ProductoTipoDos')->createQuery()->where('id=?', $values_producto['producto_tipo_dos_id'])->fetchOne();
                    $values_producto['producto_tipo_dos_name'] = $tipo_dos->getName();
                } else {
                    $values_producto['producto_tipo_dos_name'] = '';
                }
                $values_producto['producto_tipo_tres_id'] = $current_values['producto_tipo_tres_id'] > 0 ? $current_values['producto_tipo_tres_id'] : '';
                if ($values_producto['producto_tipo_tres_id'] > 0) {
                    $tipo_tres = Doctrine::getTable('ProductoTipoTres')->createQuery()->where('id=?', $values_producto['producto_tipo_tres_id'])->fetchOne();
                    $values_producto['producto_tipo_tres_name'] = $tipo_tres->getName();
                } else {
                    $values_producto['producto_tipo_tres_name'] = '';
                }
            } else {
                $values_producto['producto'] = $producto->getName();
                $values_producto['producto_nombre'] = $producto->getMarca();
                $values_producto['modelo'] = $producto->getModelo();
                $values_producto['producto_tipo_uno_id'] = $producto->getProductoTipoUnoId();
                $values_producto['producto_tipo_dos_id'] = $producto->getProductoTipoDosId();
                $values_producto['producto_tipo_dos_name'] = $producto->getProductoTipoDos()->getName();
                $values_producto['producto_tipo_tres_id'] = $producto->getProductoTipoTresId();
                $values_producto['producto_tipo_tres_name'] = $producto->getProductoTipoTres()->getName();
            }
            ?>
                $(document).ready(function() {
                    setTimeout(function() {
                        $('#concurso_producto_nombre').val('<?php echo $values_producto['producto_nombre'] ?>');
                    }, 50)
                    $('#concurso_producto').val('<?php echo $values_producto['producto'] ?>');
                    $('#concurso_modelo').val('<?php echo $values_producto['modelo'] ?>');
                    $('#concurso_producto_tipo_uno_id').val('<?php echo $values_producto['producto_tipo_uno_id'] ?>');

            <?php if ($values_producto['producto_tipo_dos_id'] == $producto->getProductoTipoDosId()): ?>
                        $('option', $('#concurso_producto_tipo_dos_id')).remove();
                        $('#concurso_producto_tipo_dos_id').append(new Option('<?php echo $values_producto['producto_tipo_dos_name'] ?>', <?php echo $values_producto['producto_tipo_dos_id'] ?>, true, true));
            <?php endif ?>
            <?php if ($values_producto['producto_tipo_tres_id'] == $producto->getProductoTipoTresId()): ?>
                        $('option', $('#concurso_producto_tipo_tres_id')).remove();
                <?php if ($values_producto['producto_tipo_tres_name']): ?>
                            $('#concurso_producto_tipo_tres_id').append(new Option('<?php echo $values_producto['producto_tipo_tres_name'] ?>', <?php echo $values_producto['producto_tipo_tres_id'] ?>, true, true));
                <?php else: ?>
                            $('#concurso_producto_tipo_tres_id')
                                    .find('option')
                                    .remove()
                                    .end()
                                    .append('<option value="">Selecciona subsector</option>');
                            $('#concurso_producto_tipo_tres_id').attr('disabled', 'disabled');
                <?php endif ?>
            <?php elseif (empty($values_producto['producto_tipo_tres_id'])): ?>
                        if ($('#concurso_producto_tipo_tres_id option').size() == 1 && $('#concurso_producto_tipo_dos_id').val() != '') {
                            $('#concurso_producto_tipo_tres_id').attr('disabled', 'disabled');
                        }
            <?php endif ?>
                });
        <?php endif; ?>
    <?php endif; ?>
<?php else: ?>
        $(document).ready(function() {
            // reordenamos combos
            /*if ($("#concurso_empresa_sector_uno_id").length > 0) {
             reorder_combobox('concurso_empresa_sector_uno_id', 'ids_ordenados_concurso_profesional_tipo_uno');
             }*/
            if ($('#concurso_empresa_sector_uno_id option:selected').val() > 0) {
                reorder_combobox('concurso_empresa_sector_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?empresa_sector_uno_id=' + $('#concurso_empresa_sector_uno_id option:selected').val());
            }
            if ($('#concurso_empresa_sector_dos_id option:selected').val() > 0) {
                reorder_combobox('concurso_empresa_sector_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?empresa_sector_dos_id=' + $('#concurso_empresa_sector_dos_id option:selected').val());
            }

            if ($("#concurso_producto_tipo_uno_id").length > 0) {
                reorder_combobox('concurso_producto_tipo_uno_id', 'ids_ordenados_concurso_producto_tipo_uno');
            }
            if ($('#concurso_producto_tipo_uno_id option:selected').val() > 0) {
                reorder_combobox('concurso_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id=' + $('#concurso_producto_tipo_uno_id option:selected').val());
            }
            if ($('#concurso_producto_tipo_dos_id option:selected').val() > 0) {
                reorder_combobox('concurso_producto_tipo_tres_id', 'ids_ordenados_concurso_producto_tipo_tres?producto_tipo_dos_id=' + $('#concurso_producto_tipo_dos_id option:selected').val());
            }

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
        });
<?php endif; ?>
    $(document).ready(function() {
        sortProvinciaList("concurso_states_id");
        $("#concurso_states_id").change(function() {
            ceuta_melilla($(this), $("#concurso_city_id"))
        });
        $("#newConcursoForm").bind("submit", function() {
            $("#concurso_city_id").removeAttr("disabled");
        });
        ceuta_melilla($("#concurso_states_id"), $("#concurso_city_id"));
        $('#concurso_borrador').bind('click', function() {
            $('#newConcursoForm').submit();
        });
    });

    function setFocus(select_box, position) {
        $('#' + select_box).addClass('gray-out');
        $('#' + select_box).prev('.blocker').show();
    }
    function unsetFocus(select_box, position) {
        $('#' + select_box).prev('.blocker').hide();
        $('#' + select_box).removeClass('gray-out');
    }
</script>