<?php

/**
 * PdCarta form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PdCartaForm extends BasePdCartaForm {

    public function configure() {
        unset($this["created_at"], $this["updated_at"]);

        $this->widgetSchema["description"]->setAttribute('cols', 50);
        $this->widgetSchema["plan_accion"]->setAttribute('cols', 50);
        $this->widgetSchema["name"]->setAttribute('class', "inputText");

        $this->widgetSchema["pd_estado_carta_id"] = new sfWidgetFormInputHidden();
        $this->setDefault("pd_estado_carta_id", 1);
        $this->widgetSchema["pd_activa_desa_id"] = new sfWidgetFormInputHidden();
        $this->setDefault("pd_activa_desa_id", 1);


        //Select con el foco por defecto
        $nuevopd = sfContext::getInstance()->getRequest()->getParameter("id");
        $this->setDefault("pd_id", $nuevopd);
    }

}

