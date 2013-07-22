<?php use_stylesheet('caja.css') ?>
<?php use_stylesheet('forms.css') ?>
<?php //use_helper('Text', 'Concursos') ?>
<div id="content_breadcroum">
    <?php print link_to('Inicio', 'home/index') ?>
    >>
    <?php print link_to('Profesional', 'profesional/index') ?>
    >>
    <?php print link_to('Empresa/Entidad', 'profesional/index'); ?>
    <?php if ($profesional->getProfesionalEstadoId() == 1): ?>
        >><?php print link_to(__('Referéndums activos'), 'profesional/index') ?>
    <?php elseif (($profesional->getProfesionalEstadoId() == 6) || ($profesional->getProfesionalEstadoId() == 7) || ($profesional->getProfesionalEstadoId() == 8)): ?>
        >><?php print link_to(__('Histórico de profesional'), 'profesional/index') ?>
    <?php endif; ?>
    >>
    <?php //print link_to_concurso($concurso) ?>
</div>
<div><?php echo link_to('vuelve a concursos', 'profesional/index?tipo='.($profesional->getTipoId()==11?'empresa':'producto')) ?></div>
<div id="content_concursos">
    <?php include_partial('profesional/profesional', array('concurso'=>$profesional, 'tipo'=>'show', 'page'=>$profesional)) ?>
     <?php if ($profesional->getProfesionalEstadoId() != '1'): //Si no está en estado de revista?>
        <div id="content_concursos_arriba2">Contribuciones</div>
        <?php foreach ($pager->getResults() as $contribucion): ?>
            <?php $extra_class = ($sf_user->isAuthenticated() and $contribucion->getUserId() == $sf_user->getGuardUser()->getId()) ? ' mi_contribucion' : '' ?>

            <div class="contribucion_normal<?php echo $extra_class ?>">
                <?php include_partial('concurso/contribucion', array('contribucion'=>$contribucion, 'destacada'=>false)) ?>
            </div>
        <?php endforeach; ?>

        <?php if(in_array($concurso->concurso_estado_id, array(4,5,6,8))): // Deliberación, Observación, Cerrado o Nulo ?>
            <?php include_partial("concurso/puntuaciones", array('concurso' => $concurso)) ?>
        <?php endif; ?>

        <?php if ($pager->haveToPaginate()): ?>
            <div class="pagination">
                <?php echo link_to(image_tag('/images/first.png', array('title' => 'Primero')), 'concurso/show?page=' . $pager->getFirstPage() . '&id=' . $concurso->id) ?>
                <?php echo link_to(image_tag('/images/previous.png', array('title' => 'Anterior')), 'concurso/show?page=' . $pager->getPreviousPage() . '&id=' . $concurso->id) ?>
                <?php foreach ($pager->getLinks() as $page): ?>
                    <?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'concurso/show?page=' . $page . '&id=' . $concurso->id) ?>
                    <?php if ($page != $pager->getCurrentMaxLink()): ?>
                        -
                    <?php endif ?>
                <?php endforeach ?>
                <?php echo link_to(image_tag('/images/next.png', array('title' => 'Siguiente')), 'concurso/show?page=' . $pager->getNextPage() . '&id=' . $concurso->id) ?>
                <?php echo link_to(image_tag('/images/last.png', array('title' => 'Último')), 'concurso/show?page=' . $pager->getLastPage() . '&id=' . $concurso->id) ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<div><?php echo link_to('vuelve a concursos', 'profesional/index?tipo='.($profesional->getTipoId()==1?'empresa':'producto')) ?></div>

<?php if ($contribucion_to_scroll): ?>
    <script>$(document).ready(function(){$('html,body').animate({scrollTop:$("#contribucion_<?php print $contribucion_to_scroll ?>").offset().top},'slow')});</script>
<?php endif; ?>