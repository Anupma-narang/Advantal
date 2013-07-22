<?php use_javascript('/js/provincias_backend.js'); ?>

<script type='text/javascript'>
    function disableSectorTres() {
        if ($('#lista_cuestionario_filters_empresa_sector_tres_id option').size() <= 1 && $('#lista_cuestionario_filters_empresa_sector_dos_id option').size() > 1) {
            $('#lista_cuestionario_filters_empresa_sector_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona actividad</option>');
            $('#lista_cuestionario_filters_empresa_sector_tres_id').attr('disabled', 'disabled');
        }
        else {

            $('#lista_cuestionario_filters_empresa_sector_tres_id').removeAttr('disabled');
        }
    }
    ;

    $(function () {
        disableSectorTres();
        $("#lista_cuestionario_filters_empresa_sector_dos_id").change(function () {
            disableSectorTres();
            
            if($("#lista_cuestionario_filters_empresa_sector_dos_id").val() == ''){
                $('#lista_cuestionario_filters_empresa_sector_tres_id').attr('disabled', 'disabled');
                //   $('#empresa_filters_empresa_sector_tres_id').removeAttr('disabled');
            }
        })

        if($("#lista_cuestionario_filters_empresa_sector_dos_id").val() == ''){
            $('#lista_cuestionario_filters_empresa_sector_tres_id').removeAttr('disabled');
        }
        //autoProvincias('empresa_filters');
    });
</script>