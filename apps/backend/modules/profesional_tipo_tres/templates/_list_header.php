<a id="hide_show_id_field" href="#">Esconder/Mostrar columna Id</a><br />
<?php use_javascript('reorder_combobox.js') ?>
<?php if ($sf_params->get('action') == 'index'): ?>
    <div>
        <div style="width:100%; padding-bottom: 8px;">
            <a id="hide_show_filters" href="#" style=" bottom: 0;display: block;margin-right: 0;margin-top: -7px;right: 0;text-align: center;top: 0;width: 100%; outline:none;"><strong>Esconder/Mostrar filtros</strong></a>
        </div>
    </div>
<?php endif; ?>

<script language="javascript">
    $(document).ready(function() {
        $(".sf_admin_list_th_id").hide();
        $(".sf_admin_list_td_id").hide();
    });
  
    $("#hide_show_id_field").click(function(){
        $(".sf_admin_list_th_id").toggle();
        $(".sf_admin_list_td_id").toggle();
    });
  
    reorder_combobox('profesional_tipo_tres_filters_profesional_tipo_uno_id', 'ids_ordenados_concurso_profesional_tipo_uno');
</script>
