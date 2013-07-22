<?php use_helper('utilAdmin', 'Text'); ?>
<h4><?php echo format_number_choice('[0]No hay comentarios pendientes|[1]Hay 1 comentario pendiente|[2,+Inf] Hay %n% comentarios pendientes', array('%n%' => $comentarios->count()), $comentarios->count());?></h4>


<ul class='alerta_cuestionario'>

    <?php foreach ($comentarios as $comentario) : ?>

    <?php if ($comentario->getReference() == 'Empresa') {
        include_partial('listaNegraEmpresa/alerta', array('comentario' => $comentario));
    } else {
        include_partial('listaNegraProducto/alerta', array('comentario' => $comentario));
    }
    ?>

    <?php endforeach ?>

    <?php include_partial('escritorio/paginador', array('pager' => $comentarios)); ?>

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
                dragbox = that.closest('.dragbox');
                that.closest('.autoload').load(dragbox.attr('rel'));

            });
            return false;
        })
    </script>