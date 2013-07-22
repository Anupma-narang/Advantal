<?php use_helper('jQuery'); ?>
<?php use_javascript('reorder_combobox.js')?>
<script type='text/javascript'>

    $("#empresa_sector_tres_empresa_sector_uno_id").change(function(){
        if ($('#empresa_sector_tres_empresa_sector_uno_id option:selected').val()>0) {
            reorder_combobox('empresa_sector_tres_empresa_sector_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?empresa_sector_uno_id='+$('#empresa_sector_tres_empresa_sector_uno_id option:selected').val());
        }
    });
    
    $("#empresa_sector_tres_empresa_sector_dos_id").change(function () {
        if ($('#empresa_sector_tres_empresa_sector_dos_id option:selected').val()>0) {
            reorder_combobox('empresa_sector_tres_empresa_sector_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?empresa_sector_dos_id='+$('#empresa_sector_tres_empresa_sector_dos_id option:selected').val());
        }
    });

    $("#concurso_producto_tipo_dos_id").change(function () {
        if ($('#concurso_producto_tipo_tres_id option').size() <= 1) {
            $('#concurso_producto_tipo_tres_id')
                .find('option')
                .remove()
                .end()
                .append('<option value="">Selecciona subsector</option>');
            $('#concurso_producto_tipo_tres_id').attr('disabled', 'disabled');
        }
        else
            $('#concurso_producto_tipo_tres_id').removeAttr('disabled');
    });
    // on ready
    $(function () {
        if ($("#empresa_sector_tres_empresa_sector_uno_id").length > 0) {
            reorder_combobox('empresa_sector_tres_empresa_sector_uno_id', 'ids_ordenados_concurso_empresa_sector_uno');
        }
        if ($('#empresa_sector_tres_empresa_sector_uno_id option:selected').val()>0) {
            reorder_combobox('empresa_sector_tres_empresa_sector_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?empresa_sector_uno_id='+$('#empresa_sector_tres_empresa_sector_uno_id option:selected').val());
        }
        if ($('#empresa_sector_tres_empresa_sector_dos_id option:selected').val()>0) {
            reorder_combobox('empresa_sector_tres_empresa_sector_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?empresa_sector_dos_id='+$('#empresa_sector_tres_empresa_sector_dos_id option:selected').val());
        }
    })
</script>

