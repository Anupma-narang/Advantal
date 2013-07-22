<div id="sf_admin_container">
    <h1><?php echo __('Detalle del Producto', array(), 'messages') ?></h1>
    <div id="sf_admin_content">
        <div class="sf_admin_list">
            <ul class="dragbox-content">
                <?php if ($producto->getCreatedAt() != '') : ?>
                    <li><strong>Fecha: </strong><?php echo $producto->getFCreatedAt("d/m/Y"); ?></li>
                <?php endif ?>
                <li><strong>Producto: </strong><?php echo $producto; ?></li>
                <li><strong>Marca: </strong><?php echo $producto->getMarca(); ?></li>
                <?php if ($producto->getModelo() != '') : ?>
                    <li><strong>Modelo: </strong><?php echo $producto->getModelo() ?></li>
                <?php endif ?>
                <?php if ($producto->getPersonaContacto() != '') : ?>
                    <li><strong>Persona contacto: </strong><?php echo $producto->getPersonaContacto() ?></li>
                <?php endif ?>

                <?php if ($producto->getTelefono() != '') : ?>
                    <li><strong>Teléfono: </strong><?php echo $producto->getTelefono() ?></li>
                <?php endif ?>

                <?php if ($producto->getEmail()) : ?>
                    <li><strong>Email: </strong><?php echo $producto->getEmail() ?></li>
                <?php endif ?>
                <li><strong>Sector: </strong><?php echo $producto->getProductoTipoUno() ?></li>
                <li><strong>Subsector: </strong><?php echo $producto->getProductoTipoDos() ?></li>
                <?php if ($producto->getProductoTipoTres()->getId()) : ?>
                    <li><strong>Tipo de producto: </strong><?php echo $producto->getTipo() ?></li>
                <?php endif ?>
                <?php if ($producto->getLista() == "lb"): ?>
                    <li><strong>Lista: </strong><?php echo __('Blanca', array(), 'messages'); ?></li>
                <?php elseif ($producto->getLista() == "ln"): ?>
                    <li><strong>Lista: </strong><?php echo __('Negra', array(), 'messages'); ?></li>
                <?php else: ?>
                    <li><strong>Lista: </strong><?php echo __('Ninguna', array(), 'messages'); ?></li>
                <?php endif; ?>

                <?php if ($producto->getLista() == "Null"): ?>
                    <li><strong>Lista: </strong>
                        <?php echo __('Ninguna', array(), 'messages'); ?>
                    </li>
                <?php endif; ?>
                <?php if ($producto->getLista() == "lb"): ?>
                    <?php if ($producto->getRawValue()->getComentarioInicial()): ?>
                        <br/>    
                        <li class="comment" style="margin-bottom: 5px;"><strong>Comentario inicial: </strong><p class="mr-span"> </p><?php echo $producto->getRawValue()->getComentarioInicial() ?>
                            <br/>
                            <span class="ver_link">                              
                                <?php echo link_to('ver +', 'producto/showComentarioInicial?id=' . $producto->getId(), array("popup" => array("popWindow", "width=650,height=500, left=200, scrollbars=1, menubar=1, scrollbars=1"), "style" => "margin: 0 0 0 -19px")) ?>
                                <?php //echo link_to('descargar pdf', 'producto/download_pdfComentario?id=' . $producto->getId()) ?>
                            </span>
                        </li>
                        <br/>
                    <?php endif ?>
                <?php endif; ?>
            </ul>

            <ul class="dragbox-content">
                <?php if ($producto->getConcursoDestacado()->getId()) : ?>
                    <li><strong>Concurso asociado: </strong><a
                            href='<?php echo url_for('concurso_show', array('id' => $producto->getConcursoDestacado()->getId())) ?>'><?php echo $producto->getConcursoDestacado() ?></a>
                    </li>
                <?php endif ?>
            </ul>

        </div>

        <ul class='sf_admin_actions'>
            <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@producto', array('class' => 'sf_admin_action_cancel')) ?></li>
            <li class='sf_admin_action_list'><?php echo link_to('Ir a Listado en lista blanca', '@producto_lista_blanca', array('class' => 'sf_admin_action_cancel')) ?></li>
            <li class='sf_admin_action_edit'><?php echo link_to('Editar', 'producto_edit', array('id' => $producto->getId()), array('class' => 'sf_admin_action_edit')) ?></li>
        </ul>
    </div>
</div>
<style type="text/css">
    .producto_ul_audit{
        float: left;
        margin: 0 0 0 11px;
        min-height: 50px;
    }
    .producto_audit{
        float: left;
        width: 98%;
        margin-left: 14px;
    }
    .producto_date{
        float: left;
        width: 135px;
    }
    .producto_user_name{
        float: left;
        width: 200px;
        padding-right: 35px;
    }
    .producto_ver_comment{
        float: left;
        width: 150px;
    }
    .producto_comentario{
        float: left;
        width: 125px;
    }
    .producto_comment_aprobar{
        float: left;
        width: 200px;
    }
    .producto_aprobar{
        float: left;
        width: 83px;
    }
    .pagination{
        float: left;
        width: 98%;
        margin: 5px 0 10px 26px;
    }
    .pagination .result{
        color: #006400;
        float: left;
        width: 85px;
        margin: -2px 0 0 0;
    }
    .producto_number{
        float: left;
        margin-top: -1px;
        width: 24px;
    }
    #sf_admin_container ul.sf_admin_actions { 
        float: left;
        width: 99%;
        margin: 10px 10px 10px 6px !important;
    }
    #sf_admin_theme_footer{
        float: left;
        margin: 0;
        padding: 0;
        text-align: center;
        width: 100%;
    }
    .ver_link{
        float: left;
        margin: 0px 0px 5px -19px;
    }
    .comment p{
        width: 100%;
    }
    .ui-dialog #dialog ul li{ list-style: disc; }
</style>
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
            window.location.reload();
        });
        return false;
    })
</script>