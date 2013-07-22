<script language="javascript">
    $(document).ready(function(){
        sortProvinciaList("concurso_states_id");
        $('.content th').css({"font-weight":"normal", "color":"#666"});
        /*  $('.sf_admin_form_field_description').prepend('<div id="Error_max_length_resumen" style="display:none;">Has superado el espacio permitido para la descripción del caso de éxito.</div>');
        $('.sf_admin_form_field_summary').prepend('<div id="error_max_length_summary" style="display:none;">Has superado el espacio permitido para el resumen del caso de éxito.</div>'); */

        $('#concurso_googlemap_lookup').click(function(){
            $('#concurso_gmap_check').val('true');
        });

        $('#concurso_googleMap_address').change(function(){
            $('#concurso_gmap_check').val('false');
        });

        $('.sf_admin_form_field_empresa tr:eq(17) td:eq(0)').prepend("<ul id='error_max_length' class='newclass'><li>Has superado el espacio permitido para el comentario inicial.</li></ul>");
        $('.sf_admin_form_field_empresa tr:eq(17) td:eq(0)').prepend("<ul id='error_max_length_negra' class='newclass'><li>Has superado el espacio permitido para el comentario.</li></ul>");

    });
</script>