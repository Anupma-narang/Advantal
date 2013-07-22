<?php use_helper('utilAdmin', 'Text'); ?>

<ul class='alerta_cuestionario'>


    <?php foreach ($respuestas as $respuesta) : ?>

    <?php if ($respuesta->getReference() == 'Empresa') {
        include_partial('empresa/tableCuestionarios', array('respuesta' => $respuesta));
    } else {
        include_partial('producto/tableCuestionarios', array('respuesta' => $respuesta));

    }
        ?>

    <?php endforeach ?>

<script type='text/javascript'>

    $('.display_comments').click(function() {
        dialog = $('#dialog');
        if (dialog.length == 0) {
            dialog = $('<div/>', {
                id:'dialog'
            });
        }
        dialog.html($(this).next().html());
        dialog.dialog({ title:'Comentario', width:400, height:250});

        return false;

    });

    $('.ajax_actions').click(function () {
        var that = $(this);
        if (that.hasClass('check')) {
            if(!confirm('Seguro que quieres borrar este cuestionario?')) {
                return false;
            }
        }
        $.post($(this).attr('href'), function (data) {
            that.closest('li').fadeOut();
        });
        return false;
    })
</script>