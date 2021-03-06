<?php

/**
 * ColaboradorNivelUno form base class.
 *
 * @method ColaboradorNivelUno getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseColaboradorNivelUnoForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'value' => new sfWidgetFormInputText(),
            'orden' => new sfWidgetFormInputText(),
            'image' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 50)),
            'value' => new sfValidatorString(array('max_length' => 50)),
            'orden' => new sfValidatorString(array('max_length' => 100)),
            'image' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('colaborador_nivel_uno[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ColaboradorNivelUno';
    }

}
