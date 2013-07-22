<?php

/**
 * Contactanos form base class.
 *
 * @method Contactanos getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContactanosForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'status' => new sfWidgetFormInputText(),
            'user_id' => new sfWidgetFormInputHidden(),
            'user_name' => new sfWidgetFormInputText(array("default" => (!$this->isNew() ? $this->getObject()->getSfGuardUser()->getUsername() : "")), array('id' => 'contactanos_user', 'maxlength' => 25, 'style' => 'width:176px;')),
            'nombre' => new sfWidgetFormInputText(),
            'apellido1' => new sfWidgetFormInputText(),
            'apellido2' => new sfWidgetFormInputText(),
            'email' => new sfWidgetFormInputText(),
            'phone' => new sfWidgetFormInputText(),
            'comentario' => new sfWidgetFormTextarea(),
            'fichero1' => new sfWidgetFormInputText(),
            'fichero2' => new sfWidgetFormInputText(),
            'fichero3' => new sfWidgetFormInputText(),
            'fichero4' => new sfWidgetFormInputText(),
            'fichero5' => new sfWidgetFormInputText(),
            'logo' => new sfWidgetFormInputText(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'status' => new sfValidatorInteger(array('required' => false)),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'required' => true)),
            'user_name' => new sfValidatorDoctrineChoice(array('required' => true, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'username'), array('required' => 'Necesitas seleccionar un Usuario.', 'invalid' => 'Ese Usuario no es válido.')),
            'nombre' => new sfValidatorString(array('max_length' => 70)),
            'apellido1' => new sfValidatorString(array('max_length' => 70)),
            'apellido2' => new sfValidatorString(array('max_length' => 70)),
            'email' => new sfValidatorString(array('max_length' => 70)),
            'phone' => new sfValidatorString(array('max_length' => 32)),
            'comentario' => new sfValidatorString(array('max_length' => 8300)),
            'fichero1' => new sfValidatorString(array('max_length' => 255)),
            'fichero2' => new sfValidatorString(array('max_length' => 255)),
            'fichero3' => new sfValidatorString(array('max_length' => 255)),
            'fichero4' => new sfValidatorString(array('max_length' => 255)),
            'fichero5' => new sfValidatorString(array('max_length' => 255)),
            'logo' => new sfValidatorString(array('max_length' => 255)),
            'created_at' => new sfValidatorDateTime(array('required' => false)),
            'updated_at' => new sfValidatorDateTime(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('contactanos[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Contactanos';
    }

}
