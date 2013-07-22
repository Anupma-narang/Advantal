<?php use_stylesheet('caja.css') ?>
<?php use_stylesheet('forms.css') ?>
<?php use_helper('Text', 'Concursos') ?>
<?php $rout_names_array = array('my_favoritos_company_contest' => 'vuelve a mis favoritos',
        'my_referendum_empresa_active' => 'vuelve a mis concursos',
    'my_referendum_empresa_history' => 'vuelve a mis concursos',
    'my_referendum_producto_active' => 'vuelve a mis concursos',
    'my_referendum_producto_history' => 'vuelve a mis concursos',
    'my_contest_empresa_active' => 'vuelve a mis concursos',
    'my_contest_empresa_history' => 'vuelve a mis concursos',
    'my_contest_producto_active' => 'vuelve a mis concursos',
    'my_contest_producto_history' => 'vuelve a mis concursos',);
  ?>
<div id="content_breadcroum">
  <?php print link_to('Inicio', 'home/index') ?>
  >>
  <?php print link_to('Concursos', 'concurso/index') ?>
  >>
  <?php print $concurso->getConcursoTipoId() == 1 ? link_to('Empresa/Entidad', 'concurso/index?tipo=empresa') : link_to('Producto', 'concurso/index?tipo=producto')  ?>
  <?php if ($concurso->getConcursoEstadoId() == 3): ?>
    >><?php print link_to(__('Referéndums activos'), 'concurso/index?tipo=' . ($concurso->getConcursoTipoId() == 1 ? 'empresa' : 'producto') . '&estado=referendum') ?>
  <?php elseif (($concurso->getConcursoEstadoId() == 6) || ($concurso->getConcursoEstadoId() == 7) || ($concurso->getConcursoEstadoId() == 8)): ?>
    >><?php print link_to(__('Histórico de concursos'), 'concurso/index?tipo=' . ($concurso->getConcursoTipoId() == 1 ? 'empresa' : 'producto') . '&estado=historico') ?>
  <?php endif; ?>
  >>
  <?php print link_to_concurso($concurso) ?>
</div>
<div>
  <?php if (isset($from)): ?>
    <?php echo link_to($rout_names_array[$from], url_for($from)); ?>
  <?php else: ?>
    <?php echo link_to('vuelve a concursos', 'concurso/index?tipo=' . ($concurso->getConcursoTipoId() == 1 ? 'empresa' : 'producto'), array('title' => ($concurso->getConcursoTipoId() == 1) ? 'Vuelve a concursos de ideas de Empresa y Entidad' : 'Vuelve a concursos de ideas de Producto')) ?>
  <?php endif; ?>

</div>
<?php if($cnt_id):?>
<div class="yl-box" id="yl-box">

</div>
<?php endif;?>
<div id="content_concursos">
  <?php include_partial('concurso/concurso', array('concurso' => $concurso, 'tipo' => 'show', 'page' => $pager->getPage(), 'contribution_id' => $contribution_id)) ?>

  <?php if ($concurso->getConcursoEstado()->getValue() != '1'): //Si no está en estado de revista?>
    <div id="content_concursos_arriba2">Contribuciones</div>
    <?php foreach ($pager->getResults() as $contribucion): ?>
      <?php $extra_class = ($sf_user->isAuthenticated() and $contribucion->getUserId() == $sf_user->getGuardUser()->getId()) ? ' mi_contribucion' : '' ?>

      <div class="contribucion_normal<?php echo $extra_class ?>" id="cn-<?php echo $contribucion->getId() ?>">
        <?php include_partial('concurso/contribucion', array('contribucion' => $contribucion, 'contribution_id' => $contribution_id, 'destacada' => $contribution_id? true: false)) ?>
      </div>
    <?php endforeach; ?>

    <?php if (in_array($concurso->concurso_estado_id, array(4, 5, 6, 8))): // Deliberación, Observación, Cerrado o Nulo ?>
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
<div>
  <?php if (isset($from)): ?>
    <?php echo link_to($rout_names_array[$from], url_for($from)); ?>
  <?php else: ?>
    <?php echo link_to('vuelve a concursos', 'concurso/index?tipo=' . ($concurso->getConcursoTipoId() == 1 ? 'empresa' : 'producto'), array('title' => ($concurso->getConcursoTipoId() == 1) ? 'Vuelve a concursos de ideas de Empresa y Entidad' : 'Vuelve a concursos de ideas de Producto')) ?>
  <?php endif; ?>
</div>

<?php if ($contribucion_to_scroll): ?>
  <script>$(document).ready(function(){$('html,body').animate({scrollTop:$("#contribucion_<?php print $contribucion_to_scroll ?>").offset().top},'slow')});</script>
<?php endif; ?>

<a id="cn-cmd" href="#cn-<?php echo $contribution_id ?>" class="hidden">contribution</a>
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
<a href="#" class="hidden" id="cnt-mover">message box</a>
<script type="text/javascript">
  $(document).ready(function(){
    $("#cn-cmd").bind('click', function(){
      window.location.href = $(this).attr('href');
    });
    $(window).bind('load', function(){
      if(<?php echo $contribution_id ? 1 : 0 ?>){
        $("#cn-cmd").trigger('click');

      }
    });


  });
  $(document).ready(function(){
    $('#user_message_ancor').fancybox({padding:5});
    $('.favourit').bind('click', function(){
      var c_id = $(this).data('id');
      $.ajax({
        url: '/concurso/addToFavorite',
        data: {id: c_id, type: "<?php echo $concurso->getEmpresaId() ? 'company' : 'product' ?>"},
        success:function(message){
          $('#user_message_content').html(message);
          $('#user_message_ancor').trigger('click');
        }
      });
    });
    $('#cnt-mover').bind('click', function(){
      window.location = window.location+$('#cnt-mover').attr('href');
    });
    if(<?php echo $cnt_id ? '1': '0'?>){
      $('#cn-'+ '<?php echo $cnt_id ? $cnt_id: ''?>').css('border','5px solid #FBB117');
      $('#cnt-mover').attr('href','#cn-'+'<?php echo $cnt_id ? $cnt_id: ''?>');
      $('#cnt-mover').trigger('click');
      //$('#yl-box').html($('#cn-<?php echo $cnt_id ? $cnt_id: null?>').html());
    }
  })
</script>