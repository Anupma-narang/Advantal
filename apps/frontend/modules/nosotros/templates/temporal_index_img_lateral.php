
 <?php //include_partial("menu_left_nosotros") ?>
   <div id="menu_side">
      <ul class="vert-one">
        <li><?php echo link_to("Quiénes somos","nosotros/quienes", array("class"=>sfContext::getInstance()->getActionName()=="quienes"?"active":""))?></li>
        <li><?php echo link_to("Cómo funcionamos","nosotros/como", array("class"=>sfContext::getInstance()->getActionName()=="como"?"active":""))?></li>
        <li><?php echo link_to("Por qué existimos","nosotros/porque", array("class"=>sfContext::getInstance()->getActionName()=="porque"?"active":""))?></li>
        <li><?php echo link_to("Nuestros servicios","nosotros/nuestros", array("class"=>sfContext::getInstance()->getActionName()=="nuestros"?"active":""))?></li>
        <li><?php echo link_to("Sistema de recompensas","nosotros/sistema", array("class"=>sfContext::getInstance()->getActionName()=="sistema"?"active":""))?></li>
        <li><?php echo link_to("Colabora","nosotros/colabora", array("class"=>sfContext::getInstance()->getActionName()=="colabora"?"active":""))?></li>
        <li><?php echo link_to("Audítanos","nosotros/audita", array("class"=>sfContext::getInstance()->getActionName()=="audita"?"active":""))?></li>
        <li><?php echo link_to("Trabaja con nosotros","nosotros/trabaja", array("class"=>sfContext::getInstance()->getActionName()=="trabaja"?"active":""))?></li>
        <li><?php echo link_to("Que se dice de auditoscopia","nosotros/quese", array("class"=>sfContext::getInstance()->getActionName()=="quese"?"active":""))?></li>
        
      
         <?php echo image_tag("img/static/porque_existimos.jpg", array("class"=>sfContext::getInstance()->getActionName()=="quienes"?"active":""))?>
      </ul>
    </div>