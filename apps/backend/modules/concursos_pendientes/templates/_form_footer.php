<?php use_javascript('reorder_combobox.js') ?>

<script language="javascript">
    $(document).ready(function() {
        sortProvinciaList("concurso_states_id");
        $('.content th').css({"font-weight": "normal", "color": "#666"});

        if ($("#concurso_Empresa_empresa_sector_uno_id").length > 0) {
            reorder_combobox('concurso_Empresa_empresa_sector_uno_id', 'ids_ordenados_concurso_empresa_sector_uno');
        }
        if ($('#concurso_Empresa_empresa_sector_uno_id option:selected').val() > 0) {
            reorder_combobox('concurso_Empresa_empresa_sector_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?empresa_sector_uno_id=' + $('#concurso_Empresa_empresa_sector_uno_id option:selected').val());
        }
        if ($('#concurso_Empresa_empresa_sector_dos_id option:selected').val() > 0) {
            reorder_combobox('concurso_Empresa_empresa_sector_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?empresa_sector_dos_id=' + $('#concurso_Empresa_empresa_sector_dos_id option:selected').val());
        }

        if ($("#concurso_Producto_producto_tipo_uno_id").length > 0) {
            reorder_combobox('concurso_Producto_producto_tipo_uno_id', 'ids_ordenados_concurso_producto_tipo_uno');
        }
        if ($('#concurso_Producto_producto_tipo_uno_id option:selected').val() > 0) {
            reorder_combobox('concurso_Producto_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id=' + $('#concurso_Producto_producto_tipo_uno_id option:selected').val());
        }
        if ($('#concurso_Producto_producto_tipo_dos_id option:selected').val() > 0) {
            reorder_combobox('concurso_Producto_producto_tipo_tres_id', 'ids_ordenados_concurso_producto_tipo_tres?producto_tipo_dos_id=' + $('#concurso_Producto_producto_tipo_dos_id option:selected').val());
        }
        $("#concurso_Empresa_empresa_sector_uno_id").change(function() {
            if ($('#concurso_Empresa_empresa_sector_uno_id option:selected').val() > 0) {
                reorder_combobox('concurso_Empresa_empresa_sector_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?empresa_sector_uno_id=' + $('#concurso_Empresa_empresa_sector_uno_id option:selected').val());
            }
        });
        $("#concurso_Empresa_empresa_sector_dos_id").change(function() {
            if ($('#concurso_Empresa_empresa_sector_dos_id option:selected').val() > 0) {
                reorder_combobox('concurso_Empresa_empresa_sector_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?empresa_sector_dos_id=' + $('#concurso_Empresa_empresa_sector_dos_id option:selected').val());
            }
        });
        $("#concurso_Producto_producto_tipo_uno_id").change(function() {
            if ($('#concurso_Producto_producto_tipo_uno_id option:selected').val() > 0) {
                reorder_combobox('concurso_Producto_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id=' + $('#concurso_Producto_producto_tipo_uno_id option:selected').val());
            }
        });
        $("#concurso_Producto_producto_tipo_dos_id").change(function() {
            if ($('#concurso_Producto_producto_tipo_dos_id option:selected').val() > 0) {
                reorder_combobox('concurso_Producto_producto_tipo_tres_id', 'ids_ordenados_concurso_producto_tipo_tres?producto_tipo_dos_id=' + $('#concurso_Producto_producto_tipo_dos_id option:selected').val());
            }
        });
    });
</script>
