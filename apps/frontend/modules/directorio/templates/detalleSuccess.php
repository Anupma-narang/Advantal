<?php $sf_user->setFlash('remember_last_state', true); ?>

<?php
include_partial("breadcrumb", array(
    'sectoresActivos' => $sectoresActivos,
    'lista' => sprintf('<a href="%s">Directorio de buenos profesionales</a> >> <a href="%s">%s</a>', url_for('lista_profesional'), url_for('lista_profesional_detalle', array('slug' => $profesional->getSlug())), $profesional->getNameForBreadcrumb())));
?>
<?php include_partial("headerlistas") ?>

<!-- buscador -->
<?php include_partial('buscadorProfesional', array('form' => $form)) ?>
<!-- fin del buscador -->

<div id="content_laslistas_lista">
    <div id="detail_point"></div>
    <div class="content-top"></div>
    <div class="content-middle">
        <div id="content_laslistas_left">
            <?php include_component('directorio', 'categoriaProfesional', array('url' => 'lista_profesional')); ?>
        </div>
        <div id="content_laslistas_left_shadow"></div>
        <div id="content_laslistas_right">
            <div class="top">
                <!--
                                <div class="order">
                <?php //include_partial('ordena', array('sortForm' => $sortForm )); ?>
                                </div>
                -->

                <!-- START flash notice message -->

                <!-- END flash message -->

            </div>
            <div id="content-results" class="main">
                <div class="top"></div>
                <div class="middle">
                    <div id='resultados_empresass'>
                        <div class="border-box">
                            <div>
                                <?php if ($sf_user->hasFlash('notice')): ?>
                                    <div id="Flash" class="flashMsgBox MB5">
                                        <div class="flash_notice">
                                            <span class="close" onClick= "$('#Flash').hide('slow');"></span>
                                            <?php echo $sf_user->getFlash('notice', ESC_RAW) ?>
                                            <?php echo $sf_user->getFlash('nueva_contribucion', ESC_RAW) ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php include_partial('profesionalDetalle', array('profesional' => $profesional, 'isRecomendation' => $isRecomendation, 'isDescription' => $isDescription, 'chartData' => $chartData)); ?>
                    </div>
                </div>
                <div class="bottom"></div>
                <?php if (($sf_context->getModuleName() == 'directorio') && ($sf_context->getActionName() == 'detalle')): ?>
                    <a href='<?php echo url_for('lista_profesional') ?>#top' title='Vuelve al Directorio de buenos profesionales'>vuelve al Directorio</a>
                <?php endif; ?>
            </div>
            <div id="content-results" class="main">
                <div id="top1"></div>
                <div class="top"></div>
                <div class="middle">
                    <input type="hidden" name="detail_link" id="detail_link" value="<?php echo url_for($letter_type_url, array('slug' => $profesional->getSlug())) ?>" />
                    <h2 style="margin-top: 0px; padding: 0px;">Cartas de <?php echo ($sf_request->hasParameter('desaprobaciones') ? 'desaprobación' : 'recomendación'); ?></h2>
                    <div id='resultados_empresas'>
                        <?php if ($pager->haveToPaginate()): ?>
                            <?php //include_partial('global/pagination', array('pager' => $pager, 'ruta' => '@lista_profesional', 'params' => array())) ?>
                        <?php endif; ?>
                        <?php foreach ($pager as $k => $comentario): ?>
                            <div class="comentario_box">
                                <?php $username = $comentario->getUserName(); ?>
                                <strong>
                                    <?php echo (($comentario['is_first'] == 1) ? '<span style="color:#B41B1D;font-weight: bold;">Recomendación de alta de auditoscopia</span>' : '<span style="color:#006400;font-weight: bold;">' . $comentario['name'] . '</span>, <span style="color: #FF1919;font-weight: bold;">' . $comentario->getUserName() ) . '</span>, <span style="font-weight: blod;">' . date("d/m/Y", strtotime($comentario['created_at'])) . '</span>'; ?>:
                                </strong>
                                <div class="comentario">
                                    <?php echo html_entity_decode($comentario->getDescription()); ?>
                                </div>
                                <?php if ($is_authenticated): ?>
                                    <?php $login_user = sfContext::getInstance()->getUser()->getUsername(); ?>
                                    <?php if ($login_user == $username && $comentario->getPlanAccion()): ?>
                                        <div class="comentario">
                                            <p>
                                                <?php echo link_to('ver Plan de acción', 'directorio/showPlanAccion?id=' . $comentario->getId(), array("class" => "plan_ver", "popup" => array("popWindow", "scrollbars=1,width=650,height=500, left=200"))) ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                        <?php if ($pager->haveToPaginate()): ?>
                            <?php include_partial('global/pagination', array('pager' => $pager, 'ruta' => url_for($letter_type_url, array('slug' => $profesional->getSlug())), 'params' => array())) ?>
                        <?php endif; ?>
                        <?php //include_partial('profesionalcomment', array('profesional' => $profesional, 'is_authenticated' => $is_authenticated, 'isRecomendation' => $isRecomendation, 'isDescription' => $isDescription)); ?>
                    </div>
                </div>
                <div class="bottom"></div>
            </div>
            <div class="bottom"></div>
        </div>
    </div>
    <div class="content-bottom"></div>
</div>
<script type='text/javascript'>
    var move_to = "top"
    <?php if($sf_request->hasParameter("move_to")): ?>
        var move_to = "<?php echo $sf_request->getParameter("move_to") ?>";
    <?php endif; ?>
    moveToTop(move_to);
    $('#menu').accordion();
</script>
<style type="text/css">
    .comentario_box{
        clear: both;
    }
    a.plan_ver{
        color: #F65E13 !important;
    }
</style>