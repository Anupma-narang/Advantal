<?php use_helper('utilAdmin', 'Text'); ?>

<div id="sf_admin_container">
    <div id="sf_admin_content">
        <div class="sf_admin_list">
            <ul class='alerta_cuestionario'>

                <?php foreach ($respuestas as $respuesta) : ?>
                <?php include_partial('producto/tableCuestionarios', array('respuesta' => $respuesta)); ?>
                <?php endforeach ?>
            </ul>

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
                    $.post($(this).attr('href'), function (data) {
                        that.closest('li').fadeOut();
                    });
                    return false;
                })
            </script>
            <ul class='sf_admin_actions'>
                <li class='sf_admin_action_list'><a href='<?php echo url_for('producto')?>'>Volver al Listado</a></li>
            </ul>
        </
        </div>
    </div>
</div>