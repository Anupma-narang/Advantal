<?php

/**
 * Auditanos form base class.
 *
 * @method Auditanos getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAuditanosForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'status' => new sfWidgetFormInputText(),
            'usuario' => new sfWidgetFormInputText(),
            'user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
            'email' => new sfWidgetFormInputText(),
            'phone' => new sfWidgetFormInputText(),
            'plan' => new sfWidgetFormTextarea(),
            'fichero1' => new sfWidgetFormInputText(),
            'fichero2' => new sfWidgetFormInputText(),
            'fichero3' => new sfWidgetFormInputText(),
            'fichero4' => new sfWidgetFormInputText(),
            'fichero5' => new sfWidgetFormInputText(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'status' => new sfValidatorInteger(array('required' => false)),
            'usuario' => new sfValidatorString(array('max_length' => 255)),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
            'email' => new sfValidatorString(array('max_length' => 255)),
            'phone' => new sfValidatorString(array('max_length' => 32, 'required' => false)),
            'plan' => new sfValidatorString(array('max_length' => 1000)),
            'fichero1' => new sfValidatorString(array('max_length' => 255)),
            'fichero2' => new sfValidatorString(array('max_length' => 255)),
            'fichero3' => new sfValidatorString(array('max_length' => 255)),
            'fichero4' => new sfValidatorString(array('max_length' => 255)),
            'fichero5' => new sfValidatorString(array('max_length' => 255)),
            'created_at' => new sfValidatorDateTime(array('required' => false)),
            'updated_at' => new sfValidatorDateTime(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('auditanos[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Auditanos';
    }

}
