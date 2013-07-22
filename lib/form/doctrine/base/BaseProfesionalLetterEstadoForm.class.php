<?php

/**
 * ProfesionalLetterEstado form base class.
 *
 * @method ProfesionalLetterEstado getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfesionalLetterEstadoForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'value' => new sfWidgetFormInputText(),
            'name' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'value' => new sfValidatorString(array('max_length' => 50)),
            'name' => new sfValidatorString(array('max_length' => 100)),
        ));

        $this->widgetSchema->setNameFormat('profesional_letter_estado[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ProfesionalLetterEstado';
    }

}
