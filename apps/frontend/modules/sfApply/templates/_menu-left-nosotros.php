    <div id="menu_side">
      <ul class="vert-one">
        <li><?php echo link_to("Quienes somos","nosotros/quienes", array("class"=>sfContext::getInstance()->getActionName()=="quienes"?"active":""))?></li>
        <li><?php echo link_to("Cómo funcionamos","nosotros/como", array("class"=>sfContext::getInstance()->getActionName()=="como"?"active":""))?></li>
        <li><?php echo link_to("Por qué existimos","nosotros/porque", array("class"=>sfContext::getInstance()->getActionName()=="porque"?"active":""))?></li>
        <li><?php echo link_to("Recompensas","nosotros/sistema", array("class"=>sfContext::getInstance()->getActionName()=="sistema"?"active":""))?></li>
        <li><?php echo link_to("Puntos y Jerarquías","nosotros/jerarquias", array("class"=>sfContext::getInstance()->getActionName()=="jerarquias"?"active":""))?></li>        
        <li><?php echo link_to("Nuestros servicios","nosotros/nuestros", array("class"=>sfContext::getInstance()->getActionName()=="nuestros"?"active":""))?></li>
        <li><?php echo link_to("Si eres empresa o entidad","nosotros/empresa", array("class"=>sfContext::getInstance()->getActionName()=="empresa"?"active":""))?></li>
       <li><?php echo link_to("Colabora","nosotros/colabora", array("class"=>sfContext::getInstance()->getActionName()=="colabora"?"active":""))?></li>
          <li><?php echo link_to("Trabaja con nosotros","nosotros/trabaja", array("class"=>sfContext::getInstance()->getActionName()=="trabaja"?"active":""))?></li>      
     <li><?php echo link_to("Audítanos","nosotros/audita", array("class"=>sfContext::getInstance()->getActionName()=="audita"?"active":"", "title" => "Audita a auditoscopia"))?></li>
        <li><?php echo link_to("Se dice de auditoscopia...","nosotros/quese", array("class"=>sfContext::getInstance()->getActionName()=="quese"?"active":""))?></li>
<!--        <li><?php //echo link_to("Nuestra mesa redonda","nosotros/quese", array("class"=>sfContext::getInstance()->getActionName()=="quese"?"active":""))?></li>-->

        <p align="left">
 <?php echo image_tag("img/static/".sfContext::getInstance()->getActionName()."_img_lateral.jpg")?>     
    </p><?php //echo image_tag("img/static/porque_existimos.jpg", array("class"=>sfContext::getInstance()->getActionName()=="quienes"?"active":""))?>
      </ul>
    </div>