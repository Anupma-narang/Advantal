<?php use_stylesheet('caja.css')?>
<?php use_stylesheet('forms.css')?>

<div id="content_breadcroum">
    <?php echo link_to("Inicio","home/index") ?> >> <?php echo link_to('Concursos', 'concurso/index')?>

    <?php //echo $tipo=='empresa'? link_to('Empresa/Entidad','concurso/index?tipo=empresa') : link_to('Producto','concurso/index?tipo=producto') ?>

    <?php if($list=='referendum'):?>
    	<?php echo link_to(__('Referéndum'),'concurso/index?tipo='.$tipo.'&list=referendum')?>
    <?php elseif($list=='historico'):?>
    	<?php echo link_to(__('Histórico de concursos'),'concurso/index?tipo='.$tipo.'&list=historico')?>
    <?php else:?>
    	<?php //echo link_to(__('Concursos abiertos'),'concurso/index?tipo='.$tipo)?>
    <?php endif;?>
</div>

<div id="content_concursos_arriba">BUSCAR UN CONCURSO</div>
<div id="content_concursos_buscador">
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php print link_to('Empresa / Entidad', 'concurso/index?tipo=empresa'.($list!='abiertos'?'&list='.$list:''), array('title' => 'Concursos de ideas de Empresa y Entidad','class'=>($tipo=='producto'?'':'active'))) ?>
        </span>
    </div>
    <div id="boton_no_activo">
        <span class="concurso_link">
            <?php print link_to('Producto', 'concurso/index?tipo=producto'.($list!='abiertos'?'&list='.$list:''), array('title' => 'Concursos de ideas de Producto','class'=>($tipo=='producto'?'active':''))) ?>
        </span>
    </div>

    <hr class="clear">
    <?php
        $count = $pager->getNbResults();
        $txt = array(
            0  => array(__('abiertos'), __('abierto')),
            1  => array(__('en revista'), __('en revista')),
            2  => array(__('activos'), __('activo')),
            3  => array(__('en Referéndum'), __('en Referéndum')),
            4  => array(__('en Deliberación'), __('en Deliberación')),
            5  => array(__('en Observación'), __('en Observación')),
            6  => array(__('cerrados'), __('cerrado')),
            7  => array(__('rechazados'), __('rechazado')),
            8  => array(__('nulos'), __('nulo')),
            9  => array(__('en borrador'), __('en borrador')),
            10 => array(__('en Revisión'), __('en Revisión')),
            11 => array('','')
        );

        if ($list=='historico') {
            $text = array(
                'titulo'  => __('Histórico de concursos'),
                'sumario' => sprintf('Hay %d %s %s',$count, ($count!=1 ? __('concursos') : __('concurso')), __('en el Histórico'))
            );
        }
        else
        {
            $estado = ($list=='referendum' ? 3 : ($form->getValue('estado_id') ? $form->getValue('estado_id') : 11));
            $text = array(
                'titulo'  =>'Concursos '.$txt[$estado][0],
                'sumario' => sprintf('Hay %d %s %s',$count, ($count!=1 ? __('concursos') : __('concurso')), $txt[$estado][($count!=1 ? 0 : 1)])
            );
        }

        if($tipo=='empresa')
            include_partial('concursoEmpresaSearchForm', array('form'=>$form, 'url'=>url_for('concurso/index?tipo=empresa'.($list!='abiertos'?'&list='.$list:'')), 'pager'=>$pager, 'text'=>$text, 'advanced'=>$advanced));
        else
            include_partial('concursoProductoSearchForm', array('form'=>$form, 'url'=>url_for('concurso/index?tipo=producto'.($list!='abiertos'?'&list='.$list:'')), 'pager'=>$pager, 'text'=>$text, 'advanced'=>$advanced));
    ?>
</div>

<div id="content_concursos">
    <div id="content_concursos_activos">

        <div id="content_concursos_activos_middle">
            <?php if(count($pager->getResults())): ?>
                <?php foreach ($pager->getResults() as $concurso): ?>
                    <?php include_partial("concurso/concurso", array("concurso" => $concurso)) ?>
                <?php endforeach; ?>

                <?php if ($pager->haveToPaginate()): ?>
                    <div class="pagination">
                        <?php print link_to_function(image_tag('/images/first.png',array('title'=>'Primera')), 'pager('.$pager->getFirstPage().')') ?>
                        <?php print link_to_function(image_tag('/images/previous.png',array('title'=>'Anterior')), 'pager('.$pager->getPreviousPage().')') ?>
                        <?php
                            $pages = array();
                            foreach ($pager->getLinks() as $page)
                            {
                                $pages[] = ($page == $pager->getPage()) ? $page : link_to_function($page, 'pager('.$page.')');
                            }
                            print implode(' - ', $pages);
                        ?>
                        <?php print link_to_function(image_tag('/images/next.png',array('title'=>'Siguiente')), 'pager('.$pager->getNextPage().')') ?>
                        <?php print link_to_function(image_tag('/images/last.png',array('title'=>'Última')), 'pager('.$pager->getLastPage().')') ?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <?php print __('No hemos encontrado concursos con esas características.') ?>
                &nbsp;|&nbsp;
                <a class="resetForm" href="#"><?php print __('nueva búsqueda') ?></a>
            <?php endif; ?>

            <?php include_partial('concurso/pizarras', array('pizarras' => $pizarras)); ?>
        </div>

    </div>
  <?php include_partial('global/black_board', array('section' => $black_board_name))?>
</div>


<div class="hidden" id="user_messagebox">
    <div class="border-box-n">
      <div class="header-left"><div class="header-right"></div></div>
      <div class="top-left">
        <div class="top-right" id="user_message_content">
        </div>
      </div>
      <div class="bottom-left">
        <div class="bottom-right"></div>
      </div>
    </div>

  </div>
  <a href="#user_messagebox" class="hidden" id="user_message_ancor">message box</a>


<script type="text/javascript">
  var pager = function(page){
    $('#filterForm_page').val(page);
    $('#filterForm').submit();
}
  $(document).ready(function(){
      sortProvinciaList("ConcursoEmpresaSearchForm_states_id");
    $("#user_messagebox").fancybox({padding: 5});
    $('#user_message_ancor').fancybox({padding:5});
    $('.favourit').bind('click', function(){
      var c_id = $(this).data('id');
      $.ajax({
        url: '/concurso/addToFavorite',
        data: {id: c_id, type: "<?php echo $tipo == 'empresa' ? 'company' : 'product' ?>"},
        success:function(message){
          $('#user_message_content').html(message);
          $('#user_message_ancor').trigger('click');
        }
      });
    });

    //contact us section
    if(<?php echo $sf_user->hasFlash('contactanos') ? 1 : 0 ?>){
      $('#user_message_content').html('<?php echo html_entity_decode($sf_user->getFlash('contactanos')) ?>');
      $("#user_messagebox").trigger('click');
    }
    //contact us section
    if(<?php echo $sf_user->hasFlash('recomienda') ? 1 : 0 ?>){
      $('#user_message_content').html('<?php echo html_entity_decode($sf_user->getFlash('recomienda')) ?>');
      $("#user_messagebox").trigger('click');
    }
  })
</script>