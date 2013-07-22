<div id="content_breadcroum">
    <?php
    echo link_to("Inicio", "home/index", array('title' => 'Inicio'));
    echo " >> ";
    echo link_to("Nosotros", "nosotros/quienes", array('title' => 'Nosotros'));
    echo " >> ";
    echo link_to($nombreSeccion, "nosotros/" . sfContext::getInstance()->getActionName(), array('title' => $tituloSeccion));

    if (isset($op) && !empty($op) && $op == 1) {
        echo " >> ";
        echo link_to("Empresa/Entidad", "nosotros/" . sfContext::getInstance()->getActionName(), array('title' => "Empresa/Entidad"));
         echo " >> ";
        echo link_to("Formulario", "nosotros/" . sfContext::getInstance()->getActionName(), array('title' => "Formulario"));
    } else if (isset($op) && !empty($op) && $op == 2) {
        echo " >> ";
        echo link_to(" Profesional", "nosotros/" . sfContext::getInstance()->getActionName(), array('title' => " Profesional"));
          echo " >> ";
        echo link_to("Formulario", "nosotros/" . sfContext::getInstance()->getActionName(), array('title' => "Formulario"));
    }
    ?>
</div>
