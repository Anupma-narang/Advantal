<?php

/**
 * MesaRedonda form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MesaRedondaForm extends BaseMesaRedondaForm {

    public function configure() {
        unset($this["created_at"], $this["updated_at"]);
        //$this->widgetSchema["name"]->setAttribute('cols',55);
        $this->widgetSchema["plan_accion"]->setAttribute('cols', 55);
        $this->widgetSchema["resumen"]->setAttribute('cols', 55);

        $this->widgetSchema["mesaredonda_estado_id"] = new sfWidgetFormInputHidden();
        $this->setDefault("mesaredonda_estado_id", 1);

        $this->widgetSchema["name"]->setAttribute('class', "anchoMr");
    }

}

class MesaRedondaForm extends BaseMesaRedondaForm {

    public function configure() {
        unset($this["created_at"], $this["updated_at"]);
    }

}