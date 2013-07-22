<?php if($sf_user->isAuthenticated()):?>
  <?php $vostros_link = "vosotros/micuenta"?>
<?php else:?>
  <?php $vostros_link = "vosotros/hierarchyRanking"?>
<?php endif;?>
<nav id="barra_nav">
    <?php echo link_to("Inicio", "home/index", array("class" => sfContext::getInstance()->getModuleName() == "home" ? "current" : " ", 'id'=>'inicio', 'title'=>'Inicio')) ?><div class="menu-separador"></div><?php echo link_to("Concursos", "concurso/index", array("class" => sfContext::getInstance()->getModuleName() == "concurso" ? "current" : " ", 'id'=>'concursos', 'title'=>'Concursos')) ?><div class="menu-separador"></div><?php echo link_to("Nosotros", "nosotros/quienes", array("class" => sfContext::getInstance()->getModuleName() == "nosotros" ? "current" : " ", 'id'=>'nosotros', 'title'=>'Nosotros')) ?><div class="menu-separador"></div><?php echo link_to("Vosotros", $vostros_link, array("class" => sfContext::getInstance()->getModuleName() == "vosotros" ? "current" : " ", 'id'=>'vosotros', 'title'=>'Vosotros')) ?><div class="menu-separador"></div><?php echo link_to("Las Listas", "lista_blanca_empresa", array(), array("class" => sfContext::getInstance()->getModuleName() == "listas" ? "current" : " ", 'id'=>'laslistas', 'title'=>'Las Listas')) ?>
    <div class="clear"></div>
</nav>
