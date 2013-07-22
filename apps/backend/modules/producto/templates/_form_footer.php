<?php use_helper('jQuery'); ?>
<?php use_javascript('ckeditor/ckeditor.js') ?>
<?php use_javascript('reorder_combobox.js') ?>
<script type='text/javascript'>

    function disableSectorTres() {
        if ($('#producto_producto_tipo_tres_id option').size() <= 1 && $('#producto_producto_tipo_dos_id option').size() > 1) {
            $('#producto_producto_tipo_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona tipo de producto</option>');
            $('#producto_producto_tipo_tres_id').attr('disabled', 'disabled');
        }
        else
            $('#producto_producto_tipo_tres_id').removeAttr('disabled');
    }

    function choiceListas() {
        lb_comment = $('.sf_admin_form_field_comentario_inicial');
        ln_comment = $('.sf_admin_form_field_texto_lista_negra');
        lb_fields = ['.sf_admin_form_field_dividendo', '.sf_admin_form_field_divisor','.sf_admin_form_field_lista_cuestionario_id'];

        if ($('#producto_lista').val() == 'lb') {
            lb_comment.show();
            ln_comment.hide();
            $.each(lb_fields, function(i, item) {
                $(item).show('fast');
            })
        } else if ($('#producto_lista').val() == 'ln') {
            lb_comment.hide();
            ln_comment.show();
            $('.sf_admin_form_field_lista_cuestionario_id option:first-child').attr('selected', 'selected');

            $.each(lb_fields, function(i, item) {
                $(item).hide('fast');
            })
        } else {
            lb_comment.hide();
            ln_comment.hide();
            $.each(lb_fields, function(i, item) {
                $(item).hide('fast');
            })
        }
    }

    $("#producto_producto_tipo_uno_id").change(function(){
        if ($('#producto_producto_tipo_uno_id option:selected').val()>0) {
            reorder_combobox('producto_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id='+$('#producto_producto_tipo_uno_id option:selected').val());
        }
    });

    $("#producto_producto_tipo_dos_id").change(function () {
        disableSectorTres();
        if ($('#producto_producto_tipo_dos_id option:selected').val()>0) {
            reorder_combobox('producto_producto_tipo_tres_id', 'ids_ordenados_concurso_producto_tipo_tres?producto_tipo_dos_id='+$('#producto_producto_tipo_dos_id option:selected').val());
        }
    });
    $('#producto_producto_tipo_dos_id').change(function(){
        if($('#producto_producto_tipo_tres_id option').size() == 1){
            $('#producto_producto_tipo_tres_id').attr('disabled','disabled');
        }
    });

    $('#producto_producto_tipo_dos_id').each(function(){
        //alert($('#concurso_producto_tipo_dos_id option:selected').val());
        if($('#producto_producto_tipo_dos_id option:selected').val()){
            if($('#producto_producto_tipo_tres_id option').size() == 1){
                $('#producto_producto_tipo_tres_id').attr('disabled','disabled');
            }
        }
    });



    // on ready
    $(function () {
        //    disableSectorTres();
        choiceListas();

        $('#producto_lista').change(function () {
            choiceListas();
        });

        if ($("#producto_producto_tipo_uno_id").length > 0) {
            reorder_combobox('producto_producto_tipo_uno_id', 'ids_ordenados_concurso_producto_tipo_uno');
        }
        if ($('#producto_producto_tipo_uno_id option:selected').val()>0) {
            reorder_combobox('producto_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id='+$('#producto_producto_tipo_uno_id option:selected').val());
        }
        if ($('#producto_producto_tipo_dos_id option:selected').val()>0) {
            reorder_combobox('producto_producto_tipo_tres_id', 'ids_ordenados_concurso_producto_tipo_tres?producto_tipo_dos_id='+$('#producto_producto_tipo_dos_id option:selected').val());
        }
    })
</script>