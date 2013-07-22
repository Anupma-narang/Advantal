<?php use_helper('jQuery'); ?>
<?php use_javascript('ckeditor/ckeditor.js') ?>
<?php use_javascript('reorder_combobox.js') ?>
<?php use_javascript('provincias_backend.js') ?>
<script type='text/javascript'>

    function disableSectorTres() {
        if ($('#profesional_profesional_tipo_tres_id option').size() <= 1 && $('#profesional_profesional_tipo_dos_id option').size() > 1) {
            $('#profesional_profesional_tipo_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona actividad</option>');
            $('#profesional_profesional_tipo_tres_id').attr('disabled', 'disabled');
        }
        else
            $('#profesional_profesional_tipo_tres_id').removeAttr('disabled');
    }
    ;

    function choiceListas() {
        lb_comment = $('.sf_admin_form_field_comentario_inicial');
        lb_fields = ['.sf_admin_form_field_dividendo', '.sf_admin_form_field_divisor','.sf_admin_form_field_lista_cuestionario_id'];
        ln_comment = $('.sf_admin_form_field_texto_lista_negra');

        if ($('#empresa_lista').val() == 'lb') {
            lb_comment.show();
            ln_comment.hide();
            $.each(lb_fields, function(i, item) {
                $(item).show('fast');
            })
        } else if ($('#empresa_lista').val() == 'ln') {
            lb_comment.hide();
            $('.sf_admin_form_field_lista_cuestionario_id option:first-child').attr('selected', 'selected');

            $.each(lb_fields, function(i, item) {
                $(item).hide('fast');
            })
            ln_comment.show();
        } else {
            lb_comment.hide();
            ln_comment.hide();
            $('.sf_admin_form_field_lista_cuestionario_id option:first-child').attr('selected', 'selected');

            $.each(lb_fields, function(i, item) {
                $(item).hide('fast');
            })
        }
    }

    sortProvinciaList("profesional_states_id");

    $('#profesional_profesional_tipo_dos_id').change(function(){
        if($('#profesional_profesional_tipo_tres_id option').size() == 1){
            $('#profesional_profesional_tipo_tres_id').attr('disabled','disabled');
        }
    });

    $('#profesional_profesional_tipo_dos_id').each(function(){
        //alert($('#concurso_producto_tipo_dos_id option:selected').val());
        if($('#profesional_profesional_tipo_dos_id option:selected').val()){
            if($('#profesional_profesional_tipo_tres_id option').size() == 1){
                $('#profesional_profesional_tipo_tres_id').attr('disabled','disabled');
            }
        }
    });


   /* $("#profesional_profesional_tipo_uno_id").change(function(){
        if ($('#profesional_profesional_tipo_uno_id option:selected').val()>0) {
            reorder_combobox('profesional_profesional_tipo_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?profesional_tipo_uno_id='+$('#profesional_profesional_tipo_uno_id option:selected').val());
        }
    });

    $("#profesional_profesional_tipo_dos_id").change(function () {
        disableSectorTres();
        if ($('#profesional_profesional_tipo_dos_id option:selected').val()>0) {
            reorder_combobox('profesional_profesional_tipo_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?profesional_tipo_dos_id='+$('#profesional_profesional_tipo_dos_id option:selected').val());
        }
    }); */

    // on ready
    $(function () {
      /*  if ($("#profesional_profesional_tipo_uno_id").length > 0) {
            reorder_combobox('profesional_profesional_tipo_uno_id', 'ids_ordenados_concurso_empresa_sector_uno');
        } */
       /* if ($('#profesional_profesional_tipo_uno_id option:selected').val()>0) {
            reorder_combobox('profesional_profesional_tipo_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?profesional_tipo_uno_id='+$('#profesional_profesional_tipo_uno_id option:selected').val());
        }
        if ($('#profesional_profesional_tipo_dos_id option:selected').val()>0) {
            reorder_combobox('profesional_profesional_tipo_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?profesional_tipo_dos_id='+$('#profesional_profesional_tipo_dos_id option:selected').val());
        } */
    })
</script>

