<?php if ($sf_user->isAuthenticated()): ?>
  <?php $vostros_link = "vosotros/micuenta" ?>
<?php else: ?>
  <?php $vostros_link = "vosotros/hierarchyRanking" ?>
<?php endif; ?>
<?php use_helper('mihelper') ?>
<?php use_javascript('fancybox/jquery.fancybox.pack.js') ?>
<?php use_stylesheet('fancybox/jquery.fancybox.css') ?>
<nav id="barra_nav">
  <div class="blk">
    <?php  $ssSelectClass = (stripos(sfContext::getInstance()->getModuleName(), 'lista') === 0 || stripos(sfContext::getInstance()->getModuleName(), 'directorio') === 0 || stripos(sfContext::getInstance()->getModuleName(), 'profesional') === 0) ? 'current' : ''; ?>
    <?php echo link_to("Inicio", "home/index", array("class" => sfContext::getInstance()->getModuleName() == "home" ? "current" : " ", 'id' => 'inicio', 'title' => 'Inicio')) ?>
    <div class="menu-separador"></div>
    <?php echo link_to("Concursos", "concurso/index", array("class" => sfContext::getInstance()->getModuleName() == "concurso" ? "current" : " ", 'id'=>'concursos', 'title'=>'Concursos')) ?>
    <div class="menu-separador"></div>
    <?php echo link_to("Nosotros", "nosotros/quienes", array("class" => sfContext::getInstance()->getModuleName() == "nosotros" ? "current" : " ", 'id'=>'nosotros', 'title'=>'Nosotros')) ?>
    <div class="menu-separador"></div>
    <?php echo link_to("Vosotros", $vostros_link, array("class" => sfContext::getInstance()->getModuleName() == "vosotros" ? "current" : " ", 'id'=>'vosotros', 'title'=>'Vosotros')) ?>
    <div class="menu-separador"></div>
    <?php echo link_to("Las Listas", "@lista_blanca_empresa", array("class" => $ssSelectClass, 'id' => 'laslistas', 'title' => 'Las Listas')) ?>
    <div class="clear"></div>
    <div></div>
  </div>
</nav>
