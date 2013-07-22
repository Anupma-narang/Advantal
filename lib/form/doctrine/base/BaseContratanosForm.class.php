<?php

/**
 * Contratanos form base class.
 *
 * @method Contratanos getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContratanosForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'status' => new sfWidgetFormInputText(),
            'name' => new sfWidgetFormInputText(),
            'road_type_id' => new sfWidgetFormInputText(),
            'cif' => new sfWidgetFormInputText(),
            'actividad' => new sfWidgetFormInputText(),
            'nombre' => new sfWidgetFormInputText(),
            'apellido1' => new sfWidgetFormInputText(),
            'apellido2' => new sfWidgetFormInputText(),
            'cargo' => new sfWidgetFormInputText(),
            'email' => new sfWidgetFormInputText(),
            'phone' => new sfWidgetFormInputText(),
            'direccion' => new sfWidgetFormInputText(),
            'num' => new sfWidgetFormInputText(),
            'piso' => new sfWidgetFormInputText(),
            'puerta' => new sfWidgetFormInputText(),
            'cp' => new sfWidgetFormInputText(),
            'states_id' => new sfWidgetFormInputText(),
            'city_id' => new sfWidgetFormInputText(),
            'ayudar' => new sfWidgetFormInputText(),
            'servicio' => new sfWidgetFormInputText(),
            'antes' => new sfWidgetFormInputText(),
            'what' => new sfWidgetFormInputText(),
            'empresa' => new sfWidgetFormInputText(),
            'form_type' => new sfWidgetFormInputCheckbox(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'status' => new sfValidatorInteger(array('required' => false)),
            'name' => new sfValidatorPass(),
            'road_type_id' => new sfValidatorInteger(array('required' => false)),
            'cif' => new sfValidatorPass(),
            'actividad' => new sfValidatorPass(),
            'nombre' => new sfValidatorPass(),
            'apellido1' => new sfValidatorPass(),
            'apellido2' => new sfValidatorPass(),
            'cargo' => new sfValidatorPass(),
            'email' => new sfValidatorPass(),
            'phone' => new sfValidatorPass(),
            'direccion' => new sfValidatorPass(),
            'num' => new sfValidatorPass(),
            'piso' => new sfValidatorPass(),
            'puerta' => new sfValidatorPass(),
            'cp' => new sfValidatorPass(),
            'states_id' => new sfValidatorPass(),
            'city_id' => new sfValidatorPass(),
            'ayudar' => new sfValidatorPass(),
            'servicio' => new sfValidatorPass(),
            'antes' => new sfValidatorPass(),
            'what' => new sfValidatorPass(),
            'empresa' => new sfValidatorPass(),
            'form_type' => new sfValidatorBoolean(array('required' => false)),
            'created_at' => new sfValidatorDateTime(array('required' => false)),
            'updated_at' => new sfValidatorDateTime(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('contratanos[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Contratanos';
    }

}
