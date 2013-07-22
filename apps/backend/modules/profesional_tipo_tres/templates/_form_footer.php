<?php use_helper('jQuery'); ?>
<?php use_javascript('reorder_combobox.js')?>
<script type='text/javascript'>

    $("#profesional_tipo_tres_profesional_tipo_uno_id").change(function(){
        if ($('#profesional_tipo_tres_profesional_tipo_uno_id option:selected').val()>0) {
            reorder_combobox('profesional_tipo_tres_profesional_tipo_dos_id', 'ids_ordenados_concurso_profesional_tipo_dos?profesional_tipo_uno_id='+$('#profesional_tipo_tres_profesional_tipo_uno_id option:selected').val());
        }
    });
    
    $("#profesional_tipo_tres_profesional_tipo_dos_id").change(function () {
        if ($('#profesional_tipo_tres_profesional_tipo_dos_id option:selected').val()>0) {
            reorder_combobox('profesional_tipo_tres_profesional_tipo_tres_id', 'ids_ordenados_concurso_profesional_tipo_tres?profesional_tipo_dos_id='+$('#profesional_tipo_tres_profesional_tipo_dos_id option:selected').val());
        }
    });

    // on ready
    $(function () {
        if ($("#profesional_tipo_tres_profesional_tipo_uno_id").length > 0) {
            reorder_combobox('profesional_tipo_tres_profesional_tipo_uno_id', 'ids_ordenados_concurso_profesional_tipo_uno');
        }
        if ($('#profesional_tipo_tres_profesional_tipo_uno_id option:selected').val()>0) {
            reorder_combobox('profesional_tipo_tres_profesional_tipo_dos_id', 'ids_ordenados_concurso_profesional_tipo_dos?profesional_tipo_uno_id='+$('#profesional_tipo_tres_profesional_tipo_uno_id option:selected').val());
        }
        if ($('#profesional_tipo_tres_profesional_tipo_dos_id option:selected').val()>0) {
            reorder_combobox('profesional_tipo_tres_profesional_tipo_tres_id', 'ids_ordenados_concurso_profesional_tipo_tres?profesional_tipo_dos_id='+$('#profesional_tipo_tres_profesional_tipo_dos_id option:selected').val());
        }
    })
</script>

