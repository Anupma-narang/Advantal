<?php

/**
 * ProfesionalesAlertas form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfesionalesAlertasForm extends BaseAlertasForm {

    public function configure() {
        unset($this['created_at'], $this['updated_at']);

        $this->widgetSchema["entity"] = new sfWidgetFormInputHidden();
        $this->setDefault("entity", 3);

        $this->widgetSchema['type'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'style' => 'width:225px'));
        $this->widgetSchema['message'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'style' => 'width:280px'));

        $this->validatorSchema['type'] = new sfValidatorString(array('required' => true, 'max_length' => 70), array('required' => 'Necesitas incluir un tipo de alerta.'));
        $this->validatorSchema['message'] = new sfValidatorString(array('required' => true, 'max_length' => 70), array('required' => 'Necestas incluir una descripción.'));
    }

}
