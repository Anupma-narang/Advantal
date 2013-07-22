<script type='text/javascript'>
    function disableSectorTres() {
        if ($('#producto_filters_producto_tipo_tres_id option').size() <= 1 && $('#producto_filters_producto_tipo_dos_id option').size() > 1) {
            $('#producto_filters_producto_tipo_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona tipo de producto</option>');
            $('#producto_filters_producto_tipo_tres_id').attr('disabled', 'disabled');
        }
        else {

            $('#producto_filters_producto_tipo_tres_id').removeAttr('disabled');
        }
    }
    ;

    $(function () {
        disableSectorTres();
        $("#producto_filters_producto_tipo_dos_id").change(function () {
            disableSectorTres();
            if($("#producto_filters_producto_tipo_dos_id").val() == ''){
                $('#producto_filters_producto_tipo_tres_id').attr('disabled', 'disabled');
                //$('#producto_filters_producto_tipo_tres_id').removeAttr('disabled');
            }
        })

        if($("#producto_filters_producto_tipo_dos_id").val() == ''){
            $('#producto_filters_producto_tipo_tres_id').removeAttr('disabled');
        }
    });
</script>