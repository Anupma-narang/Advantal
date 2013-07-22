<a id="hide_show_id_field" href="#">Esconder/Mostrar columna Id</a><br /><br />

<script language="javascript">
  $(document).ready(function() {
    $(".sf_admin_list_th_id").hide();
    $(".sf_admin_list_td_id").hide();
  });
  
  $("#hide_show_id_field").click(function(){
    $(".sf_admin_list_th_id").toggle();
    $(".sf_admin_list_td_id").toggle();
  });
</script>
