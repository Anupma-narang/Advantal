<?php use_helper('utilAdmin'); ?>
<?php use_stylesheet('ui-lightness/jquery-ui-1.8.18.custom.css'); ?>
<div id="sf_admin_container">
    <div id="sf_admin_content">
        <?php if ($sf_user->hasFlash('msg')) : ?>
            <div class='error'>
                <?php echo $sf_user->getFlash('msg'); ?>
            </div>
        <?php endif ?>

        <div class="sf_admin_list">
            <h2>Gestión de los destacados</h2>
            <h3 style="font-weight: normal;">Producto: <b><?php echo $producto->getNombreCompleto() ?></b></h3>
            <ul class='destacados'>
                <li><?php echo print_boolean_ok($producto->isDestacadoPorTipo()) ?><span class='title'>Destacado por tipo - <?php echo $producto->getTipo() ?></span>
                    <span class='action_destacado'><a
                            class='alternar-destacado  <?php echo $producto->isDestacadoPorTipo() ? 'no-destacar' : 'destacar' ?>'
                            data-error='Solo puedes destacar hasta 5 productos por tipo de producto'
                            href="<?php echo url_for('producto_alternar_destacado', array('id' => $producto->getId(), 'tipo' => 'tipo')) ?>"><?php echo $producto->isDestacadoPorTipo() ? 'Quitar destacado' : 'Destacar' ?></a>
                    </span>
                    <ul class='sortable' id='destacado_<?php echo $producto->hasActividad() ? 'producto_tipo_tres' : 'producto_tipo_dos' ?>_<?php echo $producto->getTipoId() ?>'>
                        <?php foreach ($producto->getDestacadosPorTipo() as $destacado) : ?>
                            <li id='producto_<?php echo $destacado->getProducto()->getId() ?>' class='ui-state-default'><?php echo $destacado->getProducto()->getNombreCompleto() ?><span class='edit_action'><a href='<?php echo url_for('producto_show_destacados', array('id' => $destacado->getProducto()->getId())) ?>'>Editar</a></span></li>
                        <?php endforeach ?>
                    </ul>

                </li>
                <li><?php echo print_boolean_ok($producto->isDestacadoPorMarca()) ?>
                    <span class='title'>Destacado por marca - <?php echo $producto->getMarca() ?></span>
                    <span class='action_destacado'>

                        <a
                            class='alternar-destacado <?php echo $producto->isDestacadoPorMarca() ? 'no-destacar' : 'destacar' ?>'
                            data-error='Solo puedes destacar hasta 5 productos por marca'
                            href="<?php echo url_for('producto_alternar_destacado', array('id' => $producto->getId(), 'tipo' => 'marca')) ?>"><?php echo $producto->isDestacadoPorMarca() ? 'Quitar destacado' : 'Destacar' ?></a>
                    </span>

                    <ul class='sortable' id='destacado_marca_%<?php echo $producto->getMarca() ?>%'>
                        <?php foreach ($producto->getDestacadosPorMarca() as $destacado) : ?>
                            <li id='producto_<?php echo $destacado->getProducto()->getId() ?>' class='ui-state-default'><?php echo $destacado->getProducto()->getNombreCompleto() ?><span class='edit_action'><a href='<?php echo url_for('producto_show_destacados', array('id' => $destacado->getProducto()->getId())) ?>'>Editar</a></span></li>
                        <?php endforeach ?>
                    </ul>
                </li>

                <li><?php echo print_boolean_ok($producto->isDestacadoPorProducto()) ?>
                    <span class='title'>Destacado por producto <?php echo $producto ?></span>
                    <span class='action_destacado'>
                        <a
                            class='alternar-destacado <?php echo $producto->isDestacadoPorProducto() ? 'no-destacar' : 'destacar' ?>'
                            data-error='Solo puedes destacar hasta 5 productos por nombre de producto'
                            href="<?php echo url_for('producto_alternar_destacado', array('id' => $producto->getId(), 'tipo' => 'producto')) ?>"><?php echo $producto->isDestacadoPorProducto() ? 'Quitar destacado' : 'Destacar' ?></a>
                    </span>

                    <ul class='sortable' id='destacado_producto_%<?php echo $producto->getName() ?>%'>
                        <?php foreach ($producto->getDestacadosPorProducto() as $destacado) : ?>
                            <li id='producto_<?php echo $destacado->getProducto()->getId() ?>' class='ui-state-default'><?php echo $destacado->getProducto()->getNombreCompleto() ?><span class='edit_action'><a href='<?php echo url_for('producto_show_destacados', array('id' => $destacado->getProducto()->getId())) ?>'>Editar</a></span></li>
                        <?php endforeach ?>
                    </ul>
                </li>
                <li><?php echo print_boolean_ok($producto->isDestacadoPorMarcaAndTipo()) ?>
                    <span class='title'>Destacado por marca <?php echo $producto->getMarca() ?> para tipo de producto <?php echo $producto->getTipo() ?></span>
                    <span class='action_destacado'>

                        <a
                            class='alternar-destacado <?php echo $producto->isDestacadoPorMarcaAndTipo() ? 'no-destacar' : 'destacar' ?>'
                            data-error='Solo puedes destacar hasta 5 productos por marca y tipo de producto'
                            href="<?php echo url_for('producto_alternar_destacado', array('id' => $producto->getId(), 'tipo' => 'marcaTipo')) ?>"><?php echo $producto->isDestacadoPorMarcaAndTipo() ? 'Quitar destacado' : 'Destacar' ?></a>
                    </span>

                    <ul class='sortable' id='destacado_marca_%<?php echo $producto->getMarca() ?>%'>
                        <?php foreach ($producto->getDestacadosPorMarcaAndTipo() as $destacado) : ?>
                            <li id='producto_<?php echo $destacado->getProducto()->getId() ?>' class='ui-state-default'><?php echo $destacado->getProducto()->getNombreCompleto() ?><span class='edit_action'><a href='<?php echo url_for('producto_show_destacados', array('id' => $destacado->getProducto()->getId())) ?>'>Editar</a></span></li>
                        <?php endforeach ?>
                    </ul>
                </li>
            </ul>



        </div>
        <ul class='sf_admin_actions'>
            <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@producto_lista_blanca', array('class' => 'sf_admin_action_cancel')) ?></li>
            <li class='sf_admin_action_edit'><?php echo link_to('Editar', 'producto_edit', array('id' => $producto->getId()), array('class' => 'sf_admin_action_edit')) ?></li>
        </ul>
    </div>
</div>
<style type="text/css">
    ul.destacados > li {
        width: 100%;
    }
    ul.destacados > li img {
        float: left;
    }
    ul.destacados > li .title {
        width: 90%;
        display: block;
        margin: 3px 0 0 30px; 
    }
    ul.destacados > li ul li {
        padding-left: 30px !important;
    }
    ul.destacados > li ul li span.nb_order {
        margin-left: -27px !important;
    }
</style>
<script type='text/javascript'>
    function setNumbers(list) {
        nbTag = '<span class="nb_order"/>';
        $.each($(list).find('li'), function(i, el) {
            $(el).find('.nb_order').remove();
            $(el).prepend( $(nbTag).html(i + 1));
        });
    }
    $(function() {
        $( ".sortable" ).sortable({
            placeholder: "ui-state-highlight",
            create: function(event, ui) {
                setNumbers(this);
            },
            update: function(event, ui) {
                var order = $(this).sortable('toArray');
                $.get('<?php echo url_for('producto_destacado_sort') ?>', { elements: order, type: this.id }, function(data) {
                    //do nothing...
                })
            }
        });

        $( "#sortable" ).disableSelection();

        $('a.alternar-destacado').click(function () {
            if ($(this).html() == 'Destacar') {

                items = $(this).closest('li').find('ul:first').find('li');
                if (items.length >= 5) {
                    alert($(this).attr('data-error'));
                    return false;
                }
            }


        });
    });


</script>