<?php use_helper('I18N', 'Date') ?>
<?php include_partial('concursos_pendientes_empresa/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Nuevo concurso pendiente', array(), 'messages') ?></h1>

    <?php include_partial('concursos_pendientes_empresa/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('concursos_pendientes_empresa/form_header', array('concurso' => $concurso, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('concursos_pendientes_empresa/form', array('concurso' => $concurso, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('concursos_pendientes_empresa/form_footer', array('concurso' => $concurso, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>
</div>
<?php use_javascript('jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/JqueryAutocomplete.css') ?>
<style>
    #sf_admin_container label{
        width:10.4em;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('.sf_admin_form_field_contribucion tr:eq(1) td').prepend("<ul id='Error_max_length_resumen' class='newclass' style='display: none'><li>No puedes superar las 10 líneas para el resumen de tu Plan de acción.</li></ul>");
        $('.sf_admin_form_field_contribucion tr:eq(0) td').prepend("<ul id='Error_max_length_plan_accion' class='newclass' style='display: none'><li>Has superado el espacio permitido para tu Plan de acción.</li></ul>");
        $('.sf_admin_form_field_empresa tr:eq(17) td:eq(0)').prepend("<ul id='error_max_length' class='error_list' style='display:none;'><li>Has superado el espacio permitido para el comentario inicial.</li></ul>");
        $('.sf_admin_form_field_empresa tr:eq(17) td:eq(0)').prepend("<ul id='error_max_length_negra' class='error_list' style='display:none;'><li>Has superado el espacio permitido para el comentario.</li></ul>");
        $('.sf_admin_form_field_contribucion .content label').css("width", "12em");

        //$("#sf_admin_container label").css("width","10.4em");

        $(".content table tr:nth-child(3)").hide();

        var newvar = $(".sf_admin_form_field_contribucion .error_list").html();
        if (newvar != null) {
            //$(".sf_admin_form_field_contribucion").children(":first").hide();
        }

        $("ul.error_list li").css('font-weight', 'normal');

        // select Categoría del concurso for From Tipo de concurso
        $('#concurso_concurso_tipo_id').change(function() {
            if ($(this).val() == 1) {
                $('.sf_admin_form_field_producto_nombre').hide();
                $('.sf_admin_form_field_marca').hide();
                $('.sf_admin_form_field_modelo').hide();
                $('.sf_admin_form_field_producto').hide();
                $('.sf_admin_form_field_producto_tipo_uno_id').hide();
                $('.sf_admin_form_field_producto_tipo_dos_id').hide();
                $('.sf_admin_form_field_producto_tipo_tres_id').hide();

                $('.sf_admin_form_field_empresa_nombre').show();
                $('.sf_admin_form_field_empresa_sector_uno_id').show();
                $('.sf_admin_form_field_empresa_sector_dos_id').show();
                $('.sf_admin_form_field_empresa_sector_tres_id').show();
                $('.sf_admin_form_field_road_type_id').show();
                $('.sf_admin_form_field_concurso_address').show();
                $('.sf_admin_form_field_concurso_numero').show();
                $('.sf_admin_form_field_concurso_piso').show();
                $('.sf_admin_form_field_concurso_puerta').show();
                $('.sf_admin_form_field_states_id').show();
                $('.sf_admin_form_field_city_id').show();

            }
            if ($(this).val() == 2) {
                $('.sf_admin_form_field_empresa_nombre').hide();
                $('.sf_admin_form_field_empresa_sector_uno_id').hide();
                $('.sf_admin_form_field_empresa_sector_dos_id').hide();
                $('.sf_admin_form_field_empresa_sector_tres_id').hide();
                $('.sf_admin_form_field_road_type_id').hide();
                $('.sf_admin_form_field_concurso_address').hide();
                $('.sf_admin_form_field_concurso_numero').hide();
                $('.sf_admin_form_field_concurso_piso').hide();
                $('.sf_admin_form_field_concurso_puerta').hide();
                $('.sf_admin_form_field_states_id').hide();
                $('.sf_admin_form_field_city_id').hide();

                $('.sf_admin_form_field_producto_nombre').show();
                $('.sf_admin_form_field_marca').show();
                $('.sf_admin_form_field_modelo').show();
                $('.sf_admin_form_field_producto').show();
                $('.sf_admin_form_field_producto_tipo_uno_id').show();
                $('.sf_admin_form_field_producto_tipo_dos_id').show();
                $('.sf_admin_form_field_producto_tipo_tres_id').show();
            }
            $.post("<?php echo url_for('concursos_pendientes/changeCategoryCombo'); ?>", {concurso_tipo_id: $(this).val()}, function(data) {
                $('#concurso_concurso_categoria_id').html(data);
            });

        });

        $('#concurso_concurso_tipo_id').each(function() {
            if ($(this).val() == 1) {
                $('.sf_admin_form_field_producto_nombre').hide();
                $('.sf_admin_form_field_marca').hide();
                $('.sf_admin_form_field_modelo').hide();
                $('.sf_admin_form_field_producto').hide();
                $('.sf_admin_form_field_producto_tipo_uno_id').hide();
                $('.sf_admin_form_field_producto_tipo_dos_id').hide();
                $('.sf_admin_form_field_producto_tipo_tres_id').hide();

                $('.sf_admin_form_field_empresa_nombre').show();
                $('.sf_admin_form_field_empresa_sector_uno_id').show();
                $('.sf_admin_form_field_empresa_sector_dos_id').show();
                $('.sf_admin_form_field_empresa_sector_tres_id').show();
                $('.sf_admin_form_field_road_type_id').show();
                $('.sf_admin_form_field_concurso_address').show();
                $('.sf_admin_form_field_concurso_numero').show();
                $('.sf_admin_form_field_concurso_piso').show();
                $('.sf_admin_form_field_concurso_puerta').show();
                $('.sf_admin_form_field_states_id').show();
                $('.sf_admin_form_field_city_id').show();

            }
            if ($(this).val() == 2) {
                $('.sf_admin_form_field_empresa_nombre').hide();
                $('.sf_admin_form_field_empresa_sector_uno_id').hide();
                $('.sf_admin_form_field_empresa_sector_dos_id').hide();
                $('.sf_admin_form_field_empresa_sector_tres_id').hide();
                $('.sf_admin_form_field_road_type_id').hide();
                $('.sf_admin_form_field_concurso_address').hide();
                $('.sf_admin_form_field_concurso_numero').hide();
                $('.sf_admin_form_field_concurso_piso').hide();
                $('.sf_admin_form_field_concurso_puerta').hide();
                $('.sf_admin_form_field_states_id').hide();
                $('.sf_admin_form_field_city_id').hide();

                $('.sf_admin_form_field_producto_nombre').show();
                $('.sf_admin_form_field_marca').show();
                $('.sf_admin_form_field_modelo').show();
                $('.sf_admin_form_field_producto').show();
                $('.sf_admin_form_field_producto_tipo_uno_id').show();
                $('.sf_admin_form_field_producto_tipo_dos_id').show();
                $('.sf_admin_form_field_producto_tipo_tres_id').show();
            }

        });
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

    $('#concurso_producto_tipo_dos_id').change(function() {
        if ($('#concurso_producto_tipo_tres_id option').size() == 1) {
            $('#concurso_producto_tipo_tres_id').attr('disabled', 'disabled');
        }
    });

    $('#concurso_producto_tipo_dos_id').each(function() {
        if ($('#concurso_producto_tipo_dos_id option:selected').val()) {
            if ($('#concurso_producto_tipo_tres_id option').size() == 1) {
                $('#concurso_producto_tipo_tres_id').attr('disabled', 'disabled');
            }
        }
    });
    $("form").bind("submit", function() {
        $("#concurso_city_id").removeAttr("disabled");
    });
    // For empresa autocomplete

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
    var get_empresa = function(nombre)

    {
        if (nombre == '')
            return;

        $.getJSON('/ajax_get/empresa_by_nombre?nombre=' + nombre
                );
    };

    // For product autocomplete

    $("#concurso_producto").autocomplete("<?php echo url_for('/autocompleteproducto') ?>", jQuery.extend({minLength: 4}, {
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

    $("#concurso_producto").bind('keyup', function() {
        setTimeout(function() {
            if ($("#concurso_producto").val() != '') {
                get_producto($("#concurso_producto").val());
            }
        }, 100);
    });

    var get_producto = function(nombre) {
        $.getJSON('/ajax_get/producto_by_nombre?nombre=' + nombre);
    };

    // For marca autocomplete

    var get_producto_modelo = function(marca) {
        $.getJSON('/ajax_get/producto_modelo_by_marca?marca=' + marca,
                function(data) {
                    if (data.retorno == 'true') {
                        $('#concurso_modelo').val(data.modelo);
                    }
                });
    };
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
    $("#concurso_producto_nombre").bind('keyup', function() {//alert(marca);
        setTimeout(function() {
            if ($("#concurso_producto_nombre").val() != '') {
                get_producto_modelo($("#concurso_producto_nombre").val());
            }
        }, 100);
    });

    // For modelo autocomplete

    var get_producto_modelo = function(marca) {
        $.getJSON('/ajax_get/producto_modelo_by_marca?marca=' + marca,
                function(data) {
                    if (data.retorno == 'true') {
                        $('#concurso_modelo').val(data.modelo);
                    }
                });
    };
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
        },
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

    // For Título autocomplete

    var get_producto_modelo = function(marca)
    {
        $.getJSON('/ajax_get/producto_modelo_by_marca?marca=' + marca,
                function(data) {
                    if (data.retorno == 'true') {
                        $('#concurso_name').val(data.modelo);
                    }
                });
    };
    $("#concurso_name").autocomplete("<?php echo url_for('/autocompleteconcursoname') ?>",
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
    /*
     $("#concurso_name").bind('keyup', function() {
     setTimeout(function() {
     if ($("#concurso_name").val() != '') {
     get_producto_modelo($("#concurso_name").val());
     }
     }, 100);
     });
     */

    // For direction autocomplete

    var get_producto_modelo = function(marca) {
        $.getJSON('/ajax_get/producto_modelo_by_marca?marca=' + marca,
                function(data) {
                    if (data.retorno == 'true') {
                        $('#concurso_concurso_address').val(data.modelo);
                    }
                });
    };
    $("#concurso_concurso_address").autocomplete("<?php echo url_for('/autocompleteconcursoaddress') ?>",
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
    $("#concurso_concurso_address").bind('keyup', function() {
        setTimeout(function() {
            if ($("#concurso_concurso_address").val() != '') {
                get_producto_modelo($("#concurso_concurso_address").val());
            }
        }, 100);
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
        $("#concurso_states_id").change(function() {
            ceuta_melilla($(this), $("#concurso_city_id"))
        });
        $("#newConcursoForm").bind("submit", function() {
            $("#concurso_city_id").removeAttr("disabled");
        });
        ceuta_melilla($("#concurso_states_id"), $("#concurso_city_id"));
    });
</script>

