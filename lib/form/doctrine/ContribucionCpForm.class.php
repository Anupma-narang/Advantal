<?php

/**
 * ContribucionCp form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ContribucionCpForm extends BaseContribucionCpForm {

    public function configure() {


        $this->widgetSchema["contribucion_estado_cp_id"] = new sfWidgetFormInputHidden();
        $this->setDefault("contribucion_estado_cp_id", 1);
    }

}

class ContribucionCpConcursoForm extends BaseContribucionCpForm {

    public function configure() {
        $this->useFields(array("name", "incidencia", "plan_accion", "resumen", "contribucion_estado_cp_id"));

        $this->widgetSchema["contribucion_estado_cp_id"] = new sfWidgetFormInputHidden();
        $this->setDefault("contribucion_estado_cp_id", 1);
    }

}