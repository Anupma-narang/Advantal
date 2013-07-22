<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<div class="buscador">
    <span class="buscar-concurso">Buscador de productos</span>
    <a id='top' name='top'></a>

    <div class="buscador-top"></div>

    <div class="buscador-wrapper">
        <div class="menu-buscador">
            <a class="empresas-entidades" href="<?php echo url_for('lista_blanca_empresa') ?>">Empresas/Entidades</a>
            <a class="productos-activa" href="#">Productos</a>
        </div>
        <div class="content-top"></div>
        <div class="content-middle">
            <form id='form_buscador' class="form-stacked form-stacked-blanca-producto" action="<?php echo url_for('lista_blanca_productos') ?>" method="get">
                <input type="hidden" value="" name="reset" id="resetForm"/>
                <div class="basico basico-blanca-producto">
                    <?php echo $form->renderHiddenFields() ?>
                    <div class="columna" style="margin-right: 30px !important;">
                        <strong><?php echo $form['name']->renderLabel(); ?></strong>
                        <?php echo $form['name']->render(array('maxlength' => 70)); ?>
                    </div>
                    <div class="columna" style="margin-right: 30px !important;">
                        <strong><?php echo $form['marca']->renderLabel(); ?></strong>
                        <?php echo $form['marca']->render(array('maxlength' => 70)); ?>
                    </div>
                    <div class="columna" style="margin-right: 30px !important;">
                        <strong><?php echo $form['modelo']->renderLabel(); ?></strong>
                        <?php echo $form['modelo']->render(array('maxlength' => 20)); ?>
                    </div>

                    <div class="columna" style="margin-right: 30px !important;">
                        <strong><?php echo $form['categoria_excelencia']->renderLabel(); ?></strong>
                        <?php echo $form['categoria_excelencia']->render(array('style' => 'height:22px;')); ?>
                    </div>


                    <div class="botonera">
                        <input class='btn' type="submit" value="Buscar" title="Buscar productos recomendados"/>
                        <a href='#' class='' id='limpiar_filtro' title="Nueva búsqueda de productos recomendados">nueva búsqueda</a>


                    </div>
            </form>
        </div>

    </div>
    <div class="content-bottom"></div>

</div>




<?php echo $form->renderGlobalErrors() ?>


