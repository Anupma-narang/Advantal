<?php if ($sf_request->isXmlHttpRequest()) : ?>
    <script type="text/javascript" src="/js/audAutocomplete.js"></script>
    <script type="text/javascript" src="/sfDependentSelectPlugin/js/SelectDependiente.min.js"></script>
    <script type='text/javascript'>

        $(document).ready(function () {
            $('.fancybox-wrap .sf_admin_action_save input[type="submit"]').click(function (event) {

                event.stopPropagation();
                form = $(this).closest('div').find('form');
                $.fancybox.showLoading()
                $('.fancybox-inner').html('');
                $.fancybox.reposition();
                values = $(form).serialize();
                $.post($(form).attr('action'), values, function (data) {
                    if (data == 'ok') {
                        $.fancybox.close();
                    } else {
                        $('.fancybox-inner').html(data);
                        $.fancybox.reposition();
                    }

                });

                return false;
            })


            $('.fancybox-wrap .sf_admin_action_close a').click(function (event) {
                $.fancybox.close();
                return false;
            })
            $('.fancybox-wrap .sf_admin_action_delete, .fancybox-wrap .sf_admin_action_list').hide();
        })

    </script>

<?php endif ?>

<script type='text/javascript'>
    function disableSectorTres(id) {
        if ($('#' + id + '  option').size() <= 1) {
            $('#' + id)
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona tipo de producto</option>');
            $('#' + id).attr('disabled', 'disabled');
        }
        else
            $('#' + id).removeAttr('disabled');
    }
    ;
    
    $('#lista_cuestionario_producto_tipo_dos_id').change(function(){
        if($('#lista_cuestionario_producto_tipo_dos_id option').size() == 1){
            $('#lista_cuestionario_producto_tipo_tres_id').attr('disabled','disabled');
        }
    });

    $('#lista_cuestionario_producto_tipo_dos_id').each(function(){
        //alert($('#concurso_producto_tipo_dos_id option:selected').val());
        if($('#lista_cuestionario_producto_tipo_dos_id option:selected').val()){
            if($('#lista_cuestionario_producto_tipo_tres_id option').size() == 1){
                $('#lista_cuestionario_producto_tipo_tres_id').attr('disabled','disabled');
            }
        }
    });

    $(function () {
        $("#lista_cuestionario_producto_tipo_dos_id").change(function () {
            disableSectorTres('lista_cuestionario_producto_tipo_tres_id');
        });

        //   disableSectorTres('lista_cuestionario_producto_tipo_tres_id');
        $("#lista_cuestionario_empresa_sector_dos_id").change(function () {
            disableSectorTres('lista_cuestionario_empresa_sector_tres_id');
        });

        disableSectorTres('lista_cuestionario_empresa_sector_tres_id');

    });


</script>