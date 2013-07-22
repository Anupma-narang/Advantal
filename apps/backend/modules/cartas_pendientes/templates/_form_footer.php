<?php use_javascript('reorder_combobox.js') ?>

<script language="javascript">
    
    
    $('.sf_admin_form_field_ProfesionalLetter').removeClass('errors');
    $('.sf_admin_form_field_ProfesionalLetter .error_list').each(function(){
        $(this).parent().addClass('errors')
    })
    $('.content th').css({"font-weight":"normal", "color":"#666"});
  
    if ($("#concurso_Empresa_empresa_sector_uno_id").length > 0) {
        reorder_combobox('concurso_Empresa_empresa_sector_uno_id', 'ids_ordenados_concurso_empresa_sector_uno');
    }
    if ($('#concurso_Empresa_empresa_sector_uno_id option:selected').val()>0) {
        reorder_combobox('concurso_Empresa_empresa_sector_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?empresa_sector_uno_id='+$('#concurso_Empresa_empresa_sector_uno_id option:selected').val());
    }
    if ($('#concurso_Empresa_empresa_sector_dos_id option:selected').val()>0) {
        reorder_combobox('concurso_Empresa_empresa_sector_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?empresa_sector_dos_id='+$('#concurso_Empresa_empresa_sector_dos_id option:selected').val());
    }
  
    if ($("#concurso_Producto_producto_tipo_uno_id").length > 0) {
        reorder_combobox('concurso_Producto_producto_tipo_uno_id', 'ids_ordenados_concurso_producto_tipo_uno');
    }
    if ($('#concurso_Producto_producto_tipo_uno_id option:selected').val()>0) {
        reorder_combobox('concurso_Producto_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id='+$('#concurso_Producto_producto_tipo_uno_id option:selected').val());
    }
    if ($('#concurso_Producto_producto_tipo_dos_id option:selected').val()>0) {
        reorder_combobox('concurso_Producto_producto_tipo_tres_id', 'ids_ordenados_concurso_producto_tipo_tres?producto_tipo_dos_id='+$('#concurso_Producto_producto_tipo_dos_id option:selected').val());
    }
  
  
    $("#concurso_Empresa_empresa_sector_uno_id").change(function(){
        if ($('#concurso_Empresa_empresa_sector_uno_id option:selected').val()>0) {
            reorder_combobox('concurso_Empresa_empresa_sector_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?empresa_sector_uno_id='+$('#concurso_Empresa_empresa_sector_uno_id option:selected').val());
        }
    });
    $("#concurso_Empresa_empresa_sector_dos_id").change(function(){
        if ($('#concurso_Empresa_empresa_sector_dos_id option:selected').val()>0) {
            reorder_combobox('concurso_Empresa_empresa_sector_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?empresa_sector_dos_id='+$('#concurso_Empresa_empresa_sector_dos_id option:selected').val());
        }
    });
  
    $("#concurso_Producto_producto_tipo_uno_id").change(function(){
        if ($('#concurso_Producto_producto_tipo_uno_id option:selected').val()>0) {
            reorder_combobox('concurso_Producto_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id='+$('#concurso_Producto_producto_tipo_uno_id option:selected').val());
        }
    });
    $("#concurso_Producto_producto_tipo_dos_id").change(function(){
        if ($('#concurso_Producto_producto_tipo_dos_id option:selected').val()>0) {
            reorder_combobox('concurso_Producto_producto_tipo_tres_id', 'ids_ordenados_concurso_producto_tipo_tres?producto_tipo_dos_id='+$('#concurso_Producto_producto_tipo_dos_id option:selected').val());
        }
    });
    
    $(document).ready(function() {
        if($("#profesional_ProfesionalLetter_profesional_letter_type_id").val() == 2) {
            $('.sf_admin_form_field_ProfesionalLetter table tr:eq(1) td').prepend('<ul id="Error_max_length_incidencia" class="error_list" style="display:none"><li>Has superado el espacio permitido para tu desaprobación.</li></ul>');
            $('.sf_admin_form_field_ProfesionalLetter table tr:eq(2) td').prepend('<ul id="Error_max_length_plan_accion" class="error_list" style="display:none"><li>Has superado el espacio permitido para la Plan de acción.</li></ul>');
        }else{
            $('.sf_admin_form_field_ProfesionalLetter table tr:eq(1) td').prepend('<ul id="Error_max_length_incidencia" class="error_list" style="display:none"><li>Has superado el espacio permitido para tu recomendación.</li></ul>');
        }
    });
</script>
