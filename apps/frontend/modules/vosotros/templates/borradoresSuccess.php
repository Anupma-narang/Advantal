<?php use_stylesheet('caja.css') ?>
<?php use_stylesheet('new_lista.css') ?>
<?php use_stylesheet('new_global.css') ?>
<?php include_partial('global/alert_window'); ?>
<?php use_javascript('jquery.sparkline.min.js'); ?>

<div id="content_concursos_buscador">

    <?php $type = sfContext::getInstance()->getRequest()->getParameter('type'); ?>
    <?php if ($type == 'contest'): ?>
        <?php $type = "Concursos"; ?>
    <?php elseif ($draft_type == 'contribution'): ?>
        <?php $type = "Contribuciones"; ?>
    <?php elseif ($draft_type == 'profesional'): ?>
        <?php $type = "Profesionales"; ?>
    <?php elseif ($draft_type == 'cartas'): ?>
        <?php $type = "Cartas"; ?>
    <?php endif; ?>

    <?php echo include_partial('vosotros/breadcrumb', array('nombreSeccion' => 'Mis borradores', 'tituloSeccion' => 'Mis borradores', 'type' => $type)) ?>
    <a name="top" id="top"></a>
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('type' => 'contest'); ?>
            <?php print link_to('Concursos', url_for('draft', $param), array('title' => 'Mis concursos en borrador', 'class' => ($draft_type == 'contest' ? 'active' : ''))) ?>
        </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('type' => 'contribution'); ?>
            <?php print link_to('Contribuciones ', url_for('draft', $param), array('title' => 'Mis contribuciones en borrador', 'class' => ($draft_type == 'contribution' ? 'active' : ''))) ?>
        </span>
    </div>

    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php $param = array('type' => 'profesional'); ?>
            <?php print link_to('Profesionales', url_for('draft', $param), array('title' => 'Mis profesionales en borrador', 'class' => ($draft_type == 'profesional' ? 'active' : ''))) ?>
        </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link">

            <?php $param = array('type' => 'cartas'); ?>
            <?php print link_to('Cartas', url_for('draft', $param), array('title' => 'Mis cartas en borrador', 'class' => ($draft_type == 'cartas' ? 'active' : ''))) ?>
        </span>
    </div>
</div>
<?php if (count($pager->getResults())): ?>
    <div class="rojo_marron float-right"><strong><?php echo __('Tienes ') . count($pager->getResults()) . ' ' . $record_count_message ?></strong></div>
<?php endif; ?>
<div id="content_concursos">
    <div id="content_concursos_activos">
        <div id="content_concursos_activos_top"></div>
        <div id="content_concursos_activos_middle">
            <?php if (count($pager->getResults())): ?>
                <?php if (!in_array($draft_type, array('profesional', 'cartas'))): ?>
                    <?php foreach ($pager->getResults() as $draft_record): ?>
                        <?php include_partial($draft_prtial, array($draft_object => $draft_record, 'option' => $draft_option)) ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div id="content_laslistas_right">
                        <div class="main" id="content-results">
                            <div class="top"></div>
                            <div class="middle">
                                <?php include_partial($draft_prtial, array($draft_object => $pager->getResults(), 'option' => $draft_option)) ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($pager->haveToPaginate()): ?>
                    <div class="pagination">
                        <?php print link_to_function(image_tag('/images/first.png', array('title' => 'Primera')), 'pager(' . $pager->getFirstPage() . ')') ?>
                        <?php print link_to_function(image_tag('/images/previous.png', array('title' => 'Anterior')), 'pager(' . $pager->getPreviousPage() . ')') ?>
                        <?php
                        $pages = array();
                        foreach ($pager->getLinks() as $page) {
                            $pages[] = ($page == $pager->getPage()) ? $page : link_to_function($page, 'pager(' . $page . ')');
                        }
                        print implode(' - ', $pages);
                        ?>
                        <?php print link_to_function(image_tag('/images/next.png', array('title' => 'Siguiente')), 'pager(' . $pager->getNextPage() . ')') ?>
                        <?php print link_to_function(image_tag('/images/last.png', array('title' => 'Última')), 'pager(' . $pager->getLastPage() . ')') ?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <strong><?php echo $empty_message; ?></strong>
            <?php endif; ?>


        </div>
        <div id="content_concursos_activos_botton"></div>
    </div>

</div>
<?php if (isset($concursos)): ?>
    <?php if (count($concursos)): ?>
        <?php foreach ($concursos as $concurso): ?>
            <?php $concurso->concurso_tipo_id == 1 ? $tipo = "empresa" : $tipo = "producto" ?>
            <li><?php echo link_to($concurso->name, "concurso/edit?id=" . $concurso->id . "&tipo=" . $tipo) ?></li>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>
<li>&nbsp;</li>
<?php if (isset($profesionales)): ?>
    <?php if (count($profesionales)): ?>
        <li><strong> Mis profesionales en borrador</strong></li>
        <?php foreach ($profesionales as $profesional): ?>
            <li>
                <?php
                $snIdLetter = Doctrine::getTable('ProfesionalLetter')->getLatestIsFirst($profesional->id, $sf_user->getAttribute('user_id', '', 'sfGuardSecurityUser'));

                $snId = ($snIdLetter) ? '&lid=' . $snIdLetter : '';
                echo link_to($profesional->last_name_one . " " . $profesional->last_name_two . ", " . $profesional->first_name, "profesional/index?id=" . $profesional->id . $snId);
                ?>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>
<li>&nbsp;</li>
<?php if (isset($contribuciones)): ?>
    <?php if (count($contribuciones)): ?>
        <li><strong> Mis contribuciones en borrador</strong></li>
        <?php foreach ($contribuciones as $contribucion): ?>
            <li><?php echo link_to($contribucion->name, "contribucionuno/edit?id=" . $contribucion->id) ?></li>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>
<li>&nbsp;</li>
<?php if (isset($cartas_profesionales)): ?>
    <?php if (count($cartas_profesionales)): ?>
        <li><strong> Mis cartas profesionales en borrador</strong></li>
        <?php foreach ($cartas_profesionales as $profesional): ?>
            <li><?php echo link_to($profesional->Profesional->last_name_one . " " . $profesional->Profesional->last_name_two . ", " . $profesional->Profesional->first_name, "profesional/" . (($profesional->profesional_letter_type_id == 1) ? "recomend" : "disaproval") . "?idprofesional=" . $profesional->Profesional->id . '&letter_id=' . $profesional->id) ?></li>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>
<li>&nbsp;</li>
</ul>
</div>

<div id="content_vosotros_bot"></div>
</div>
<script type='text/javascript'>
    $(function() {
        $('.spanMsg').text($('.spanMsgThis').text());
        $('.dynamicBar').sparkline('html', {
            type: 'bar',
            barColor: 'green',
            colorMap: {
                '1': '#429D29',
                '2': '#B41B1D',
                '3': '#BEC1C4',
                '4': '#F65E13'
            },
            tooltipFormat: '{{value:levels}}',
            tooltipValueLookups: {
                levels: {'1': 'Sin medalla', '2': 'Bronze', '3': 'Plata', '4': 'Oro'}
            }
        });

    });

    function setUrl(id, url)
    {
        $("#wholeDiv" + id).attr('onclick', "window.location.href='" + url + "'");
    }
</script>
