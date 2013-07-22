<?php

/**
 * MesaredondaReferendum form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MesaredondaReferendumForm extends BaseMesaredondaReferendumForm {

    public function configure() {
        unset($this["created_at"], $this["updated_at"]);
        $this->widgetSchema["value"] = new sfWidgetFormChoice(array("choices" => $this->getOption('valores'), "expanded" => "true"));

        $this->setDefault("mesa_redonda_id", $this->getOption('mesaredonda'));
        $this->widgetSchema["mesa_redonda_id"] = new sfWidgetFormInputHidden();


        $this->setDefault("mesaredonda_ponencia_id", $this->getOption('ponencia'));
        $this->widgetSchema["mesaredonda_ponencia_id"] = new sfWidgetFormInputHidden();

        //$this->widgetSchema["mesa_redonda_id"] = new sfWidgetFormInputHidden();
        //$this->widgetSchema["mesaredonda_ponencia_id"] = new sfWidgetFormInputHidden();
        //$this->widgetSchema->setNameFormat('concurso_referendum[%s]');
        $this->widgetSchema->setNameFormat($this->getOption('ponencia') . '_mesaredonda_referendum[%s]');
    }

}
