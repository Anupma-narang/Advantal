<a id="hide_show_codigo_field" href="#">Esconder/Mostrar columna Código</a><br /><br />

<script language="javascript">
  $(document).ready(function() {
    $(".sf_admin_list_th_codigo").hide();
    $(".sf_admin_list_td_codigo").hide();
  });
  
  $("#hide_show_codigo_field").click(function(){
    $(".sf_admin_list_th_codigo").toggle();
    $(".sf_admin_list_td_codigo").toggle();
  });
</script>