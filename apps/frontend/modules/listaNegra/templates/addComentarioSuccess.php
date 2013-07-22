<?php use_javascript('ckeditor/ckeditor.js') ?>
<?php //si hubieran usado slots esto sería menos engorroso... tantos if por aquí.... :(  ?>

<?php if ($type == 'producto') : ?>
    <?php include_partial("listaBlanca/breadcrumb", array('sectoresActivos' => $sectoresActivos,
        'lista' => sprintf('<a href="%s">Lista negra de productos</a> >> <a href="%s">%s >> comenta</a>', url_for('lista_negra_producto'), url_for('lista_negra_producto_comenta', array('slug' => $object->getSlug())), $object->getNameForBreadcrumb(' ')))); ?>

<?php else : ?>
    <?php include_partial("listaBlanca/breadcrumb", array('sectoresActivos' => $sectoresActivos,
        'lista' => sprintf('<a href="%s">Lista negra de empresas y entidades</a> >> <a href="%s">%s >> comenta</a>', url_for('lista_negra_empresa'), url_for('lista_negra_empresa_comenta', array('slug' => $object->getSlug())), $object->getNameForBreadcrumb(' >> ')))); ?>

<?php endif ?>

<?php include_partial("listaNegra/headerlistas") ?>

<!-- buscador -->
<?php if ($type == 'producto') : ?>
    <?php include_partial('buscadorProductos', array('form' => $searchForm)) ?>
<?php else : ?>
    <?php include_partial('buscadorEmpresa', array('form' => $searchForm)) ?>

<?php endif ?>


<!-- fin del buscador -->

<div id="content_laslistas_lista">
    <div class="menu-buscador">
        <?php if ($type == 'producto') : ?>
            <a class="empresas-entidades" href="<?php echo url_for('lista_negra_empresa') ?>">Empresas/Entidades</a>
            <a class="productos-activa" href="">Productos</a>
        <?php else : ?>

            <a class="empresas-entidades-activa" href="#">Empresas/Entidades</a>
            <a class="productos" href="<?php echo url_for('lista_negra_producto') ?>">Productos</a>
        <?php endif ?>
    </div>


    <div class="content-top"></div>
    <div class="content-middle">
        <div id="content_laslistas_left">
            <?php include_component('listaBlanca', 'categoriaEmpresas', array('url' => 'lista_negra_empresa')); ?>
        </div>
        <div id="content_laslistas_left_shadow"></div>
        <div id="content_laslistas_right">

            <div class="main cuestionario">
                <div class="top"></div>
                <div class="middle addComentario">
                    <h3>Tu comentario sobre <?php echo $type == 'empresa' ? $object->getName() . ' en ' . $object->getMunicipioProvincia() : $object->getName() . ' ' . $object->getMarcaModelo() ?></h3>

                    <form action='<?php echo url_for('lista_negra_' . $type . '_comenta', array('slug' => $object->getSlug())) ?>'
                          method="post">

                        <?php echo $form->renderHiddenFields(); ?>
                        <?php if ($form->hasErrors()): ?>
                            <div class="form_row_error" style="margin: 5px 5px 5px 0">
                                <p>Necesitas introducir un comentario.</p>
                            </div>
                        <?php endif; ?>
                        <div>
                            <div id="error_max_length" class="form_row_error" style="display:none; margin:5px 5px 5px 0;">
                                <p>Has superado el espacio permitido para tu comentario.</p>
                            </div>
                            <?php echo $form['comentario']->render() ?>

                        </div>
                        <div>
                            <input type='submit' value='Publica'/>
                            <a href='<?php echo url_for('lista_negra_' . $type) ?>'>cancela</a>

                        </div>

                </div>
                <div class="bottom"></div>
            </div>

        </div>
    </div>
    <div class="content-bottom"></div>
</div>
<script type='text/javascript'>
    moveToTop('top');
</script>