<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<div class="buscador">

    <span class="buscar-concurso">Buscador de empresas</span>
    <a id='top' name='top'></a>

    <div class="buscador-top"></div>
    <div class="buscador-wrapper">
        <div class="menu-buscador">
            <a class="empresas-entidades-activa" href="#">Empresas/Entidades</a>
            <a class="productos" href="<?php echo url_for('lista_blanca_productos') ?>">Productos</a>
        </div>
        <div class="content-top"></div>
        <div class="content-middle">
            <form id='form_buscador' class="form-stacked" action="<?php echo url_for('@lista_blanca_empresa') ?>" method="get">
                <input type="hidden" value="" name="reset" id="resetForm"/>
                <div class="basico">
                    <?php echo $form->renderHiddenFields() ?>
                    <div class="columna">
                        <strong><?php echo $form['name']->renderLabel(); ?></strong>
                        <?php echo $form['name']->render(array('style' => 'width:201px;margin-right:-1px;', 'maxlength' => 70)); ?>
                    </div>
                    <div class="columna">
                        <strong><?php echo $form['states_id']->renderLabel(); ?></strong>
                        <?php echo $form['states_id']->render(array('style' => 'width:193px;margin-right:-1px;height:22px;')); ?>
                    </div>
                    <div class="columna">
                        <strong><?php echo $form['localidad_id']->renderLabel(); ?></strong>
                        <?php echo $form['localidad_id']->render(array('style' => 'width:245px;height:22px;')); ?>
                    </div>
                    <div class="columna">
                        <strong><?php echo $form['categoria_excelencia']->renderLabel(); ?></strong>
                        <?php echo $form['categoria_excelencia']->render(array('style' => 'width:163px;height:22px;')); ?>
                    </div>

                    <div class="botonera">
                        <input class='btn' type="submit" value="Buscar" title="Buscar empresas y entidades recomendadas"/>
                        <a href='#' class='' id='limpiar_filtro' title='Nueva búsqueda de empresas y entidades recomendadas'>nueva búsqueda</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="content-bottom"></div>

    </div>




    <?php echo $form->renderGlobalErrors() ?>

    <script type="text/javascript">
        $(document).ready(function(){
            sortProvinciaList("empresa_filters_states_id");
            if($("#empresa_filters_states_id").val() == 0){
                $('#empresa_filters_localidad_id').attr('disabled', 'disabled');
            }

        });
    </script>


