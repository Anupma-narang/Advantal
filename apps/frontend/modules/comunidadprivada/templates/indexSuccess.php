<?php use_stylesheet('caja.css')?>
<?php use_stylesheet('forms.css')?>


<?php if($tipo=='producto'):?>
    <?php include_partial('buscador_order_producto', array('searchForm' => $searchForm, 'advanced' => $advanced, 'tipo' => $tipo))?>
<?php elseif ($tipo=='empresa'):?>
    <?php include_partial('buscador_order_empresa', array('searchForm' => $searchForm, 'advanced' => $advanced, 'tipo' => $tipo))?>
<?php endif;?>

<?php if (isset($selected_ConcursoEstado)):?>
    <div class="color_text" id="content_titulo_contribucion">Concursos <?php echo $selected_ConcursoEstado->name?></div>
<?php else:?>
    <div class="color_text" id="content_titulo_contribucion">Concursos activos</div>
<?php endif;?>


<div id="content_concursos">
    <div id="content_concursos_activos">
        <div id="content_concurso_activos_boton">
            <div id="boton_noactivo">
                <span class="concurso_link_no">
                    <?php if ($estado == 2): ?>
                        <?php echo link_to("Empresa / Entidad", "concurso/index?tipo=empresa",array("class"=>$tipo=="empresa"?"active":"")) ?>
                    <?php elseif ($estado == 3): ?>
                        <?php echo link_to("Empresa / Entidad", "concurso/index?tipo=empresa&list=referendum",array("class"=>$tipo=="empresa"?"active":"")) ?>
                    <?php elseif ($estado == 6): ?>
                        <?php echo link_to("Empresa / Entidad", "concurso/index?tipo=empresa&estado=historico",array("class"=>$tipo=="empresa"?"active":""))?>
                    <?php endif; ?>
                </span>
            </div>
            <div id="boton_noactivo">
                <span class="concurso_link_no">
                    <?php if ($estado == 2): ?>
                        <?php echo link_to("Producto", "concurso/index?tipo=producto",array("class"=>$tipo=="producto"?"active":"")) ?>
                    <?php elseif ($estado == 3): ?>
                        <?php echo link_to("Producto", "concurso/index?tipo=producto&estado=referendum",array("class"=>$tipo=="producto"?"active":"")) ?>
                    <?php elseif ($estado == 6): ?>
                        <?php echo link_to("Producto", "concurso/index?tipo=producto&estado=historico",array("class"=>$tipo=="producto"?"active":"")) ?>
                    <?php endif; ?>
                </span>
            </div>
            <div id="num_concursos_activos">Hay <?php echo $n_concursos?> concursos activos</div>
            </div>

              <div id="content_concursos_activos_top"></div>
              <div id="content_concursos_activos_middle">

<?php if(count($pager->getResults())):?>
    <?php foreach ($pager->getResults() as $concurso):?>
        <?php include_partial("concurso/concurso", array("concurso" => $concurso)) ?>
    <?php endforeach;?>


    <?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <?php echo link_to(image_tag('/images/first.png',array('title'=>'Primera')), 'concurso/index?page='.$pager->getFirstPage().'&tipo='.$tipo) ?>
        <?php echo link_to(image_tag('/images/previous.png',array('title'=>'Anterior')), 'concurso/index?page='.$pager->getPreviousPage().'&tipo='.$tipo) ?>
        <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
            <?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'concurso/index?page='.$page.'&tipo='.$tipo) ?>
            <?php if ($page != $pager->getCurrentMaxLink()): ?> - <?php endif ?>
        <?php endforeach ?>
        <?php echo link_to(image_tag('/images/next.png',array('title'=>'Siguiente')), 'concurso/index?page='.$pager->getNextPage().'&tipo='.$tipo) ?>
        <?php echo link_to(image_tag('/images/last.png',array('title'=>'Última')), 'concurso/index?page='.$pager->getLastPage().'&tipo='.$tipo) ?>
    </div>
    <?php endif ?>
<?php else:?>
    No hemos encontrado concursos con esas características.
<?php endif;?>
    </div>
        <div id="content_concursos_activos_botton"></div>
    </div>
</div>