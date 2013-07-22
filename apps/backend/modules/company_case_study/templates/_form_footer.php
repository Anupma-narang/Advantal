<?php use_helper('jQuery'); ?>
<?php use_javascript('ckeditor/ckeditor.js') ?>
<?php use_javascript('provincias_backend.js') ?>
<?php use_javascript('reorder_combobox.js')?>
<script type='text/javascript'>

    function disableSectorTres() {
        if ($('#empresa_empresa_sector_tres_id option').size() <= 1 && $('#empresa_empresa_sector_dos_id option').size() > 1) {
            $('#empresa_empresa_sector_tres_id')
                .find('option')
                .remove()
                .end()
                .append('<option value="">Selecciona actividad</option>');
            $('#empresa_empresa_sector_tres_id').attr('disabled', 'disabled');
        }
        else
            $('#empresa_empresa_sector_tres_id').removeAttr('disabled');
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

    sortProvinciaList("company_case_study_states_id");
    $("#empresa_empresa_sector_uno_id").change(function(){
        if ($('#empresa_empresa_sector_uno_id option:selected').val()>0) {
            reorder_combobox('empresa_empresa_sector_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?empresa_sector_uno_id='+$('#empresa_empresa_sector_uno_id option:selected').val());
        }
    });

    $("#empresa_empresa_sector_dos_id").change(function () {
       // disableSectorTres();
        if ($('#empresa_empresa_sector_dos_id option:selected').val()>0) {
            reorder_combobox('empresa_empresa_sector_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?empresa_sector_dos_id='+$('#empresa_empresa_sector_dos_id option:selected').val());
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

    $('#empresa_empresa_sector_dos_id').change(function(){
        if($('#empresa_empresa_sector_tres_id option').size() == 1){
            $('#empresa_empresa_sector_tres_id').attr('disabled','disabled');
        }
    });

    $('#empresa_empresa_sector_dos_id').each(function(){
        //alert($('#concurso_producto_tipo_dos_id option:selected').val());
        if($('#empresa_empresa_sector_dos_id option:selected').val()){
            if($('#empresa_empresa_sector_tres_id option').size() == 1){
                $('#empresa_empresa_sector_tres_id').attr('disabled','disabled');
            }
        }
    });

    // on ready
    $(function () {
        autoProvincias('empresa');
       // disableSectorTres();

        $('#empresa_lista').change(function () {
            choiceListas();
        });
        $('#empresa_states_id').change(function() {
            choiceProvincia();
        })
        $('#empresa_lista').trigger('change');

        if ($("#empresa_empresa_sector_uno_id").length > 0) {
            reorder_combobox('empresa_empresa_sector_uno_id', 'ids_ordenados_concurso_empresa_sector_uno');
        }
        if ($('#empresa_empresa_sector_uno_id option:selected').val()>0) {
            reorder_combobox('empresa_empresa_sector_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?empresa_sector_uno_id='+$('#empresa_empresa_sector_uno_id option:selected').val());
        }
        if ($('#empresa_empresa_sector_dos_id option:selected').val()>0) {
            reorder_combobox('empresa_empresa_sector_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?empresa_sector_dos_id='+$('#empresa_empresa_sector_dos_id option:selected').val());
        }
    })
</script>

