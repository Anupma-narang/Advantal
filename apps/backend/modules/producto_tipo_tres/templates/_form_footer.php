<?php use_helper('jQuery'); ?>
<?php use_javascript('reorder_combobox.js')?>
<script type='text/javascript'>

    $("#producto_tipo_tres_producto_tipo_uno_id").change(function(){
        if ($('#producto_tipo_tres_producto_tipo_uno_id option:selected').val()>0) {
            reorder_combobox('producto_tipo_tres_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id='+$('#producto_tipo_tres_producto_tipo_uno_id option:selected').val());
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
        if ($("#producto_tipo_tres_producto_tipo_uno_id").length > 0) {
            reorder_combobox('producto_tipo_tres_producto_tipo_uno_id', 'ids_ordenados_concurso_producto_tipo_uno');
        }
        if ($('#producto_tipo_tres_producto_tipo_uno_id option:selected').val()>0) {
            reorder_combobox('producto_tipo_tres_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id='+$('#producto_tipo_tres_producto_tipo_uno_id option:selected').val());
        }
    })
</script>

