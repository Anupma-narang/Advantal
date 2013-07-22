<?php

/**
 * CuestionarioRespuestas form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CuestionarioRespuestasForm extends BaseCuestionarioRespuestasForm {

    public function configure() {
        $this->widgetSchema['respuesta1'] = new sfWidgetFormChoice(array('expanded' => true, 'choices' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5')));
        $this->validatorSchema['respuesta1'] = new sfValidatorChoice(array('required' => true, 'choices' => array('1', '2', '3', '4', '5')));
        $this->widgetSchema['respuesta2'] = new sfWidgetFormChoice(array('expanded' => true, 'choices' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5')));
        $this->validatorSchema['respuesta2'] = new sfValidatorChoice(array('required' => true, 'choices' => array('1', '2', '3', '4', '5')));
        $this->widgetSchema['respuesta3'] = new sfWidgetFormChoice(array('expanded' => true, 'choices' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5')));
        $this->validatorSchema['respuesta3'] = new sfValidatorChoice(array('required' => true, 'choices' => array('1', '2', '3', '4', '5')));
        $this->widgetSchema['respuesta4'] = new sfWidgetFormChoice(array('expanded' => true, 'choices' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5')));
        $this->validatorSchema['respuesta4'] = new sfValidatorChoice(array('required' => true, 'choices' => array('1', '2', '3', '4', '5')));
        $this->widgetSchema['respuesta5'] = new sfWidgetFormChoice(array('expanded' => true, 'choices' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5')));
        $this->validatorSchema['respuesta5'] = new sfValidatorChoice(array('required' => true, 'choices' => array('1', '2', '3', '4', '5')));
        $this->widgetSchema['respuesta6'] = new sfWidgetFormChoice(array('expanded' => true, 'choices' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5')));
        $this->validatorSchema['respuesta6'] = new sfValidatorChoice(array('required' => true, 'choices' => array('1', '2', '3', '4', '5')));
        $this->widgetSchema['respuesta7'] = new sfWidgetFormChoice(array('expanded' => true, 'choices' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5')));
        $this->validatorSchema['respuesta7'] = new sfValidatorChoice(array('required' => true, 'choices' => array('1', '2', '3', '4', '5')));
        $this->widgetSchema['respuesta8'] = new sfWidgetFormChoice(array('expanded' => true, 'choices' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5')));
        $this->validatorSchema['respuesta8'] = new sfValidatorChoice(array('required' => true, 'choices' => array('1', '2', '3', '4', '5')));
        $this->widgetSchema['respuesta9'] = new sfWidgetFormChoice(array('expanded' => true, 'choices' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5')));
        $this->validatorSchema['respuesta9'] = new sfValidatorChoice(array('required' => true, 'choices' => array('1', '2', '3', '4', '5')));
        $this->widgetSchema['respuesta10'] = new sfWidgetFormChoice(array('expanded' => true, 'choices' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5')));
        $this->validatorSchema['respuesta10'] = new sfValidatorChoice(array('required' => true, 'choices' => array('1', '2', '3', '4', '5')));
        $this->widgetSchema['respuesta11'] = new sfWidgetFormChoice(array('expanded' => true, 'choices' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5')));
        $this->validatorSchema['respuesta11'] = new sfValidatorChoice(array('required' => true, 'choices' => array('1', '2', '3', '4', '5')));
        $this->widgetSchema['respuesta12'] = new sfWidgetFormChoice(array('expanded' => true, 'choices' => array('5' => 'Si', '1' => 'No')));
        $this->validatorSchema['respuesta12'] = new sfValidatorChoice(array('required' => true, 'choices' => array('5', '1')));
        $this->validatorSchema['respuesta13'] = new sfValidatorString(array('required' => true));

        $this->widgetSchema['cuestionario_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['concurso_id'] = new sfWidgetFormInputHidden();

        $this->useFields(array('respuesta1', 'respuesta2', 'respuesta3', 'respuesta4', 'respuesta5', 'respuesta6', 'respuesta7', 'respuesta8', 'respuesta9', 'respuesta10', 'respuesta11', 'respuesta12', 'respuesta13'));
    }

}