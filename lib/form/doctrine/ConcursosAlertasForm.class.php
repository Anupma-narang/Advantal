<?php

/**
 * ConcursosAlertas form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ConcursosAlertasForm extends BaseAlertasForm {

    public function configure() {
        unset($this['created_at'], $this['updated_at']);

        $this->widgetSchema["entity"] = new sfWidgetFormInputHidden();
        $this->setDefault("entity", 1);
        $this->widgetSchema['message'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 12300));

        $this->validatorSchema['type'] = new sfValidatorString(array('required' => true, 'max_length' => 50), array('required' => 'No has incluido un tipo de alerta'));
        $this->validatorSchema['message'] = new sfValidatorString(array('required' => true, 'max_length' => 10000), array('required' => 'No has incluido un mensaje'));
    }

}
