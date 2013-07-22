<?php use_helper('utilAdmin', 'Text'); ?>
<h4><?php echo format_number_choice('[0]No hay auditorías pendientes|[1]Hay 1 auditoría pendiente|[2,+Inf] Hay %n% auditorías pendientes', array('%n%' => $respuestas->count()), $respuestas->count());?></h4>

<ul class='alerta_cuestionario'>

    <?php foreach ($respuestas->getResults() as $respuesta) : ?>

    <?php if ($respuesta->getReference() == 'Empresa') {
        include_partial('empresa/alerta', array('respuesta' => $respuesta));
    } else {
        include_partial('producto/alerta', array('respuesta' => $respuesta));

    }
    ?>

    <?php endforeach ?>


   <?php include_partial('escritorio/paginador', array('pager' => $respuestas)); ?>

    <script type='text/javascript'>

        $('.display_comments').click(function () {
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
                if (!confirm(this.title)) {
                    return false;
                }
            }
            $.post($(this).attr('href'), function (data) {
                that.closest('li').fadeOut();
                //reload window
                dragbox = that.closest('.dragbox');

                that.closest('.autoload').load(dragbox.attr('rel'));

            });
            return false;
        });

    </script>