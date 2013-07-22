<?php use_helper('jQuery'); ?>
<?php use_javascript('reorder_combobox.js')?>
<script type='text/javascript'>

    // on ready
    $(function () {
        if ($("#empresa_sector_dos_empresa_sector_uno_id").length > 0) {
            reorder_combobox('empresa_sector_dos_empresa_sector_uno_id', 'ids_ordenados_concurso_empresa_sector_uno');
        }
    })
</script>

