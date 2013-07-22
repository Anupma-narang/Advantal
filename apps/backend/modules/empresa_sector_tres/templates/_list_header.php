<a id="hide_show_id_field" href="#">Esconder/Mostrar columna Id</a><br /><br />
<?php use_javascript('reorder_combobox.js')?>

<script language="javascript">
  $(document).ready(function() {
    $(".sf_admin_list_th_id").hide();
    $(".sf_admin_list_td_id").hide();
  });
  
  $("#hide_show_id_field").click(function(){
    $(".sf_admin_list_th_id").toggle();
    $(".sf_admin_list_td_id").toggle();
  });
  
  reorder_combobox('empresa_sector_tres_filters_empresa_sector_uno_id', 'ids_ordenados_concurso_empresa_sector_uno');
</script>