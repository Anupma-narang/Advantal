<?php

/**
 * MesaredondaPonencia form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MesaredondaPonenciaForm extends BaseMesaredondaPonenciaForm {

    public function configure() {
        $this->widgetSchema["plan_accion"]->setAttribute('cols', 55);
        $this->widgetSchema["resumen"]->setAttribute('cols', 55);
        $this->widgetSchema["name"]->setAttribute('class', "anchoNp");

        $this->widgetSchema["mesa_redonda_id"] = new sfWidgetFormInputHidden();
        $this->setDefault("mesa_redonda_id", 1);
    }

}

class MesaredondaPonenciaFormUno extends BaseMesaredondaPonenciaForm {

    public function configure() {
        $mesaredondaid = sfContext::getInstance()->getRequest()->getParameter("mesa_redonda_id");
        $this->widgetSchema["mesa_redonda_id"] = new sfWidgetFormInputHidden();
        $this->setDefault("mesa_redonda_id", $mesaredondaid);

        $this->widgetSchema["mesaredonda_estado_id"] = new sfWidgetFormInputHidden();
        $this->setDefault("mesaredonda_estado_id", 1);

        $this->widgetSchema["plan_accion"]->setAttribute('cols', 65);
        $this->widgetSchema["plan_accion"]->setAttribute('rows', 6);

        $this->widgetSchema["resumen"]->setAttribute('cols', 65);
        $this->widgetSchema["resumen"]->setAttribute('rows', 4);

        $this->widgetSchema["name"]->setAttribute('class', "anchoPon");
        $this->widgetSchema["asunto"]->setAttribute('class', "anchoPon");
    }

}