<?php use_javascript('ckeditor/ckeditor.js') ?>
<?php use_javascript('jquery.sparkline.min.js'); ?>
<?php use_stylesheet('caja'); ?>

<?php include_partial("listaBlanca/breadcrumb", array('sectoresActivos' => $sectoresActivos,
    'lista' => sprintf('<a href="%s">Lista blanca de productos</a> >> <a href="%s">%s >> audita</a>', url_for('lista_blanca_productos'), url_for('lista_blanca_audita_producto', array('slug' => $producto->getSlug())), $producto->getNameForBreadcrumb(' >> ')))); ?>

<?php include_partial("listaBlanca/headerlistas") ?>

<!-- buscador -->
<?php include_partial('buscadorProductos', array('form' => $filter)) ?>
<!-- fin del buscador -->

<div id="content_laslistas_lista">
    <div class="menu-buscador">
        <a class="empresas-entidades" href="<?php echo url_for('lista_blanca_empresa') ?>">Empresas/Entidades</a>
        <a class="productos-activa" href="#">Productos</a>
    </div>
    <div class="content-top"></div>
    <div class="content-middle">
        <div id="content_laslistas_left">
            <?php include_component('listaBlancaProducto', 'categoriaProductos', array('url' => 'lista_blanca_productos')); ?>
        </div>
        <div id="content_laslistas_left_shadow"></div>
        <div id="content_laslistas_right">

            <div class="top">
                <div class="order">
                    <?php include_partial('ordena', array('sortForm' => $sortForm)); ?>
                </div>
            </div>

            <div class="main">
                <div class="top"></div>
                <div class="middle_audit">
                    <div id=''>
                        <div class="main cuestionario">


                            <h3>Cuestionario del producto <strong><?php echo $producto->getNombreCompleto() ?></strong>
                            </h3>
                            <?php if ($form->getObject()->isNew()): ?>
                                <form action="<?php echo url_for('lista_blanca_audita_producto', array('slug' => $producto->getSlug())) ?>" method="post">
                                <?php else: ?>
                                    <form action="<?php echo url_for('lista_blanca_audita_guardar', array('id' => $form->getObject()->getId())) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
                                    <?php endif; ?>


                                    <?php if (!$form->getObject()->isNew()): ?>
                                        <input type="hidden" name="sf_method" value="put"/>
                                    <?php endif; ?>

                                    <?php echo $form->renderHiddenFields() ?>

                                    <div class='preguntas'>

                                        <?php foreach ($form['Preguntas'] as $pregunta) : ?>
                                            <?php if ($pregunta->getName() == "respuesta26"): ?>
                                                <label for="lista_cuestionario_user_Preguntas_respuesta13_respuesta">Puedes hacer el comentario que quieras:</label>
                                                <div id="error_max_length" class="form_row_error" style="display:none; margin:5px 5px 5px 0;">
                                                    <p>Has superado el espacio permitido para tus comentarios.</p>                                            
                                                </div>
                                                <?php if ($form->hasErrors()): ?>
                                                    <div class="form_row_error">
                                                        <p><strong>Para auditar necesitas dar tu opinión en todas la preguntas</strong>.</p>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php echo $pregunta->render(); ?>
                                        <?php endforeach ?>
                                        <input name="guardar" type="submit" value="Publica"/>
                                        <a href='<?php echo url_for('lista_blanca_productos') ?>'>cancela</a>
                                    </div>
                                </form>
                        </div>
                        <div class="bottom"></div>
                    </div>
                </div>
            </div>
            <div class="content-bottom"></div>
        </div>
    </div>
</div>
<script type='text/javascript'>
    moveToTop('top');
    $(document).ready(function(){
        $('label[for=lista_cuestionario_user_Preguntas_respuesta26_respuesta]:last').hide();
    })
</script>