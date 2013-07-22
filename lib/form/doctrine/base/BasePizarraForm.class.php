<?php

/**
 * Pizarra form base class.
 *
 * @method Pizarra getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePizarraForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'text' => new sfWidgetFormTextarea(),
            'seccion' => new sfWidgetFormInputText(),
            'visibilidad' => new sfWidgetFormInputText(),
            'velocidad' => new sfWidgetFormInputText(),
            'desde' => new sfWidgetFormDateTime(),
            'hasta' => new sfWidgetFormDateTime(),
            'days' => new sfWidgetFormInputText(),
            'months' => new sfWidgetFormInputText(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 150)),
            'text' => new sfValidatorString(array('max_length' => 3000)),
            'seccion' => new sfValidatorPass(),
            'visibilidad' => new sfValidatorPass(),
            'velocidad' => new sfValidatorInteger(),
            'desde' => new sfValidatorDateTime(array('required' => false)),
            'hasta' => new sfValidatorDateTime(array('required' => false)),
            'days' => new sfValidatorPass(),
            'months' => new sfValidatorPass(),
            'created_at' => new sfValidatorDateTime(array('required' => false)),
            'updated_at' => new sfValidatorDateTime(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('pizarra[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Pizarra';
    }

}
