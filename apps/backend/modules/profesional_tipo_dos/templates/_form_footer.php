<?php use_helper('jQuery'); ?>
<?php use_javascript('reorder_combobox.js')?>
<script type='text/javascript'>

    // on ready
    $(function () {
        if ($("#profesional_tipo_dos_profesional_tipo_uno_id").length > 0) {
            reorder_combobox('profesional_tipo_dos_profesional_tipo_uno_id', 'ids_ordenados_concurso_profesional_tipo_uno');
        }
    })
</script>

