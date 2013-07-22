<?php use_javascript('/js/provincias_backend.js'); ?>
<script type='text/javascript'>
    function disableSectorTres() {
        if ($('#empresa_filters_empresa_sector_tres_id option').size() <= 1 && $('#empresa_filters_empresa_sector_dos_id option').size() > 1) {
            $('#empresa_filters_empresa_sector_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona actividad</option>');
            $('#empresa_filters_empresa_sector_tres_id').attr('disabled', 'disabled');
        }
        else {

            $('#empresa_filters_empresa_sector_tres_id').removeAttr('disabled');
        }
    }
    ;

    $(function () {
        disableSectorTres();
        $("#empresa_filters_empresa_sector_dos_id").change(function () {
            disableSectorTres();
            
            if($("#empresa_filters_empresa_sector_dos_id").val() == ''){
                $('#empresa_filters_empresa_sector_tres_id').attr('disabled', 'disabled');
                //   $('#empresa_filters_empresa_sector_tres_id').removeAttr('disabled');
            }
        })

        if($("#empresa_filters_empresa_sector_dos_id").val() == ''){
            $('#empresa_filters_empresa_sector_tres_id').removeAttr('disabled');
        }
        autoProvincias('empresa_filters');
    });
</script>