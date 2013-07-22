<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<?php use_stylesheet('profesionals.css'); ?>
<?php use_helper('alternativeLink'); ?>
<div class="buscador">
    <span class="buscar-concurso">BUSCAR PROFESIONALES</span>
    <a id='top' name='top'></a>
    <div class="buscador-top"></div>
    <div class="buscador-wrapper">
        <div class="content-top"></div>
        <div class="content-middle">
            <form id='form_buscador' class="form-stacked" action="<?php echo url_for('@lista_profesional') ?>"
                  method="get">
                <div class="basico">
                    <?php echo $form->renderHiddenFields() ?>
                    <div class="columna">
                        <strong><?php echo $form['name']->renderLabel(); ?></strong>
                        <?php echo $form['name']->render(array('style' => 'width:201px;margin-right:-1px;')); ?>
                    </div>
                    <div class="columna">
                        <strong><?php echo $form['last_name_one']->renderLabel(); ?></strong>
                        <?php echo $form['last_name_one']->render(array('style' => 'width:201px;margin-right:-1px;')); ?>
                    </div>
                    <div class="columna">
                        <strong><?php echo $form['last_name_two']->renderLabel(); ?></strong>
                        <?php echo $form['last_name_two']->render(array('style' => 'width:201px;margin-right:-1px;')); ?>
                    </div>
                    <div class="columna">
                        <strong><?php echo $form['states_id']->renderLabel(); ?></strong>
                        <?php echo $form['states_id']->render(array('style' => 'width:193px;margin-right:-1px;height:22px;')); ?>
                    </div>
                    <div class="columna">
                        <strong><?php echo $form['city_id']->renderLabel(); ?></strong>
                        <?php echo $form['city_id']->render(array('style' => 'width:245px;height:22px;')); ?>
                    </div>

                    <div class="botonera">
                        <a href='#' class='' id='limpiar_filtro' title='Nueva búsqueda de profesionales recomendados'>nueva búsqueda</a>
                        <input class='btn' type="submit" value="Buscar" title="Buscar profesionales recomendados"/>
                    </div>
                </div>
            </form>
        </div>
        <div class="content-bottom"></div>
    </div>
    <div id="crear_concurso">
        <div class="redbtn" style="float: left;">
            <?php //echo link_to('Recomienda un nuevo profesional',"profesional/index", array('class'=>'login_required', 'message'=>'Para <strong>dar de alta un profesional</strong> necesitas ser colaborador.')); ?>
            <?php echo authenticated_link_to($sf_user, "Recomienda un nuevo profesional", "profesional/index", "Recomienda un nuevo profesional", "nosotros_lightboxes/accesocuenta?texto=2&redirect=profesionalindex", array('title' => 'Recomienda un nuevo profesional para formar parte del Directorio'), array('title' => 'Recomienda un nuevo profesional para formar parte del Directorio', 'class' => 'lightbox-i')) ?>
        </div><div class="spanMsg"></div>
    </div>
</div>
<?php echo $form->renderGlobalErrors() ?>
<script type="text/javascript">
    $(document).ready(function(){
        if($("#profesional_filters_states_id").val() == 0){
            $('#profesional_filters_city_id').attr('disabled', 'disabled');
        }
        //setTimeout('sortProvinciaList("profesional_filters_states_id")', 2000);
        sortProvinciaList("profesional_filters_states_id");

        <?php /*if(isset($ms_values['states_id']) && !empty($ms_values['states_id'])):  ?>
                $("#profesional_filters_states_id").val(<?php echo $ms_values['states_id']; ?>);
                $('#profesional_filters_states_id').trigger('change');
                $("#profesional_filters_city_id").val(<?php echo $ms_values['city_id']; ?>);
                actualizarEstadoBuscador();
                $("#orderForm_states_id").val(<?php echo $ms_values['states_id']; ?>);
                $("#orderForm_states_id").trigger('change');
                $("#orderForm_city_id").val(<?php echo $ms_values['city_id']; ?>);
                sincronizeValues("buscador");
        <?php endif;*/ ?>
    });
</script>