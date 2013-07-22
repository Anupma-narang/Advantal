<?php include_partial("breadcrumb", array('sectoresActivos' => $sectoresActivos, 'lista' => '<strong>Directorio de buenos profesionales</strong>')) ?>
<?php include_partial("headerlistas") ?>
<?php include_partial('global/alert_window'); ?>
<?php use_javascript('jquery.sparkline.min.js'); ?>
<?php use_stylesheet('caja.css') ?>
<!-- buscador -->

<?php include_partial('buscadorProfesional', array('form' => $form, 'ms_values' => $ms_values)) ?>

<!-- fin del buscador -->
<div id="content_laslistas_lista">
    <div class="content-top"></div>
    <div class="content-middle">
        <div id="content_laslistas_left">
            <?php include_component('directorio', 'categoriaProfesional', array('url' => 'lista_profesional')); ?>
        </div>
        <div id="content_laslistas_left_shadow"></div>
        <div id="content_laslistas_right">
            <div class="top">
                <div class="order">
                    <?php include_partial('ordena', array('sortForm' => $sortForm, 'order_type' => $order_type)); ?>
                </div>
            </div>
            <div id="content-results" class="main">
                <div class="top"></div>
                <div class="middle">
                    <?php if (isset($profesional_tipo_uno)): ?>
                        <div class="title">
                            <?php if ($profesional_tipo_uno->getImage() && file_exists("images/uploads/thumbnails/" . $profesional_tipo_uno->getImage())): ?>
                                <?php echo image_tag('/images/uploads/thumbnails/' . $profesional_tipo_uno->getImage(), array('class' => 'miniatura-categoria')) ?>
                            <?php endif; ?>
                            <span><?php echo $profesional_tipo_uno->getName() ?></span>
                        </div>
                    <?php endif ?>

                    <div id='resultados_empresas'>
                        <?php include_partial('resultadosProfesional', array('pager' => $pager, 'profesionalDestacadas' => $profesionalDestacadas, 'buscandoPorSector' => $buscandoPorSector, 'ms_values' => $ms_values, 'sectoresActivos' => $sectoresActivos)); ?>
                    </div>
                    <div class='block_reset'>
<!--                        <a href='#' id='vuelve_lista' title='Vuelve al Directorio de buenos profesionales'>vuelve al Directorio</a>-->
                        <a href='<?php echo url_for('lista_profesional') ?>#top' title='Vuelve al Directorio de buenos profesionales'>vuelve al Directorio</a>
                    </div>
                    <?php include_partial('global/black_board', array('section' => 'D')) ?>
                </div>
                <div class="bottom"></div>
            </div>
            <div class="bottom"></div>
        </div>
    </div>
    <div class="content-bottom"></div>

</div>

<?php
include_partial('global/login_required', array(
    'msg' => "Para crear un concurso <strong>necesitas ser colaborador</strong>",
));
?>
<script type="text/javascript">
    $('#menu').accordion();
</script>