<?php use_stylesheet('forms.css') ?>
<?php use_stylesheet('concurso.css') ?>
<?php use_stylesheet('profesionals.css') ?>
<?php //use_helper('Text', 'Concursos')  ?>



<div id="content_breadcroum" style="float:left">
    <!--    <?php //print link_to('Inicio', 'home/index')  ?>
        >>
    <?php //print link_to('Profesional', 'profesional/index') ?>
        >>
    <?php //print link_to('Empresa/Entidad', 'profesional/index'); ?>
    <?php //if ($profesional->getProfesionalEstadoId() == 1): ?>
            >><?php //print link_to(__('Referéndums activos'), 'profesional/index')  ?>
    <?php //elseif (($profesional->getProfesionalEstadoId() == 6) || ($profesional->getProfesionalEstadoId() == 7) || ($profesional->getProfesionalEstadoId() == 8)): ?>
            >><?php //print link_to(__('Histórico de profesional'), 'profesional/index')  ?>
    <?php //endif; ?>-->

    <?php echo link_to("Inicio", "home/index") ?>
    >>
    <?php echo link_to('Las Listas', 'listaBlanca/index') ?>
    >>
    <?php echo link_to('Directorio de buenos profesionales', 'directorio/index') ?>
    >>
    <?php echo link_to('nuevo profesional', 'profesional/index') ?>

</div>



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
                </div>
            </div>
            <div id="content-results" class="main">
                <div class="top"></div>
                <div class="middle">
                    <div id='resultados_empresas'>
                        <!-- START flash notice message -->
                        <div class="border-box">
                            <div>
                                <?php if ($sf_user->hasFlash('notice')): ?>
                                    <div id="Flash" class="flashMsgBox">
                                        <div class="" title="cierra este mensaje"></div>
                                        <div class="flash_notice">
                                            <span class="close"><?php echo link_to_function('', "$('#Flash').hide('slow');") ?></span>
                                            <?php
                                            echo html_entity_decode($sf_user->getFlash('notice'));
                                            echo html_entity_decode($sf_user->getFlash('nueva_contribucion'));
                                            $sf_user->setFlash('notice', '', false);
                                            $sf_user->setFlash('nueva_contribucion', '', false);
                                            ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- END flash message -->
                        <div class="border-box">
                            <?php //include_partial('resultadosProfesional', array('pager' => $pager, 'profesionalDestacadas' => $profesionalDestacadas, 'buscandoPorSector' => $buscandoPorSector )); ?>
                            <div style="float:left"><?php echo link_to('vuelve al Directorio', 'directorio/index#top') ?></div>
                            <div id="content_concursos">
                                <?php include_partial('profesional/profesional', array('concurso' => $profesional, 'tipo' => 'show', 'page' => $profesional, 'form' => $form, 'dataProfesional' => $dataProfesional)) ?>
                            </div>

                            <div style="float:left">
                                <?php
                                if ($sf_params->get('mode') == 'borador')
                                    echo link_to('vuelve a mis borradores', url_for('vosotros/borradores'));
                                else
                                    echo link_to('vuelve al Directorio', 'directorio/index#top');
                                ?>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="bottom"></div>
            </div>
        </div>
    </div>
    <?php if (isset($contribucion_to_scroll)): ?>
        <script>$(document).ready(function(){$('html,body').animate({scrollTop:$("#contribucion_<?php print $contribucion_to_scroll ?>").offset().top},'slow')});</script>
    <?php endif; ?>
