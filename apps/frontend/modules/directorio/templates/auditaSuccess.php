<?php use_javascript('ckeditor/ckeditor.js') ?>
<?php use_javascript('jquery.sparkline.min.js'); ?>
<?php use_stylesheet('caja');?>


<?php include_partial("breadcrumb", array('sectoresActivos' => $sectoresActivos,
    'lista' => sprintf('<a href="%s">Lista blanca de empresas y entidades</a> >> <a href="%s">%s >> audita</a>', url_for('lista_blanca_empresa'), url_for('lista_blanca_audita_empresa', array('slug' => $empresa->getSlug())), $empresa->getNameForBreadcrumb()))); ?>

<?php include_partial("headerlistas") ?>

<!-- buscador -->
<?php include_partial('buscadorEmpresa', array('form' => $filter)) ?>
<!-- fin del buscador -->

<div id="content_laslistas_lista">
    <div class="menu-listas">
        <a href="#" class="empresa active">Empresas/Entidades </a>
        <a href="<?php echo url_for('lista_blanca_productos')?>" class="producto">Productos</a>
    </div>
    <div class="content-top"></div>
    <div class="content-middle">
        <div id="content_laslistas_left">
            <?php include_component('listaBlanca', 'categoriaEmpresas', array('url' => 'lista_blanca_empresa'));?>
        </div>
        <div id="content_laslistas_left_shadow"></div>
        <div id="content_laslistas_right">
            <div class="top">
                <div class="order">
                    <?php include_partial('ordena', array('sortForm' => $sortForm));?>
                </div>
            </div>
            <div id="content-results" class="main">
                <div class="top"></div>
                <div class="middle_audit">
                    <div id='resultados_empresas' >
                        <div class="main cuestionario">
                            <h3>Cuestionario de la empresa <strong><?php echo $empresa->getName() ?></strong></h3>
            <form action="<?php echo url_for('lista_blanca_audita_empresa', array('slug' => $empresa->getSlug())) ?>"
                  method="post">

                            <?php if ($form->hasErrors()): ?>
                            <div class="form_row_error">
                                <p><strong>Para auditar necesitas dar tu opinión en todas la preguntas</strong>.</p>
                            </div>
                            <?php endif; ?>

                            <?php echo $form->renderHiddenFields() ?>

                            <div class='preguntas'>

                                <?php foreach ($form['Preguntas'] as $pregunta) : ?>
                                <?php echo $pregunta->render(); ?>
                                <?php endforeach ?>
                                <div id="error_max_length" class="form_row_error" style="display:none">
                                    <p>Has superado el espacio permitido para tus comentarios</p>
                                </div>


                                <input name="guardar" type="submit" value="Publica"/>
                                <a href='<?php echo url_for('lista_blanca_empresa')?>'>cancela</a>
                            </div>
                        </form>
                            </div>
                        <!-- fi div middle -->
                        <div class="bottom"></div>
                    </div>
                    <div class="bottom"></div>
                </div>
            </div>
            <div class="content-bottom"></div>
        </div>


        <script type='text/javascript'>
            moveToTop('top');
        </script>