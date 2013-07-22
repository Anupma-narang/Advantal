<?php use_helper('jQuery'); ?>
<?php use_javascript('reorder_combobox.js')?>
<script type='text/javascript'>

    // on ready
    $(function () {
        if ($("#producto_tipo_dos_producto_tipo_uno_id").length > 0) {
            reorder_combobox('producto_tipo_dos_producto_tipo_uno_id', 'ids_ordenados_concurso_producto_tipo_uno');
        }
    })
</script>

