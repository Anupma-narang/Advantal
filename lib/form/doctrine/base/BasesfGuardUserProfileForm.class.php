<?php

/**
 * sfGuardUserProfile form base class.
 *
 * @method sfGuardUserProfile getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserProfileForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'user_id' => new sfWidgetFormInputHidden(),
            'email' => new sfWidgetFormInputText(),
            'name' => new sfWidgetFormInputText(),
            'surname1' => new sfWidgetFormInputText(),
            'surname2' => new sfWidgetFormInputText(),
            'active' => new sfWidgetFormInputText(),
            'fecha_nac' => new sfWidgetFormDate(),
            'validate' => new sfWidgetFormInputText(),
            'image' => new sfWidgetFormInputText(),
            'direccion' => new sfWidgetFormInputText(),
            'numero' => new sfWidgetFormInputText(),
            'piso' => new sfWidgetFormInputText(),
            'puerta' => new sfWidgetFormInputText(),
            'cp' => new sfWidgetFormInputText(),
            'telefono' => new sfWidgetFormInputText(),
            'colaborador_nivel_uno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ColaboradorNivelUno'), 'add_empty' => true)),
            'colaborador_nivel_dos_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ColaboradorNivelDos'), 'add_empty' => true)),
            'metodo_cobro_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MetodoCobro'), 'add_empty' => true)),
            'rank' => new sfWidgetFormInputText(),
            'accumulated_points' => new sfWidgetFormInputText(),
            'hierarchy' => new sfWidgetFormInputText(),
            'change_points' => new sfWidgetFormInputText(),
            'money' => new sfWidgetFormInputText(),
            'money_sum' => new sfWidgetFormInputText(),
            'road_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoadType'), 'add_empty' => true)),
            'states_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'add_empty' => false)),
            'city_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => true)),
            'sex' => new sfWidgetFormInputText(),
            'formacion_academica_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FormacionAcademica'), 'add_empty' => true)),
            'is_online' => new sfWidgetFormInputCheckbox(),
            'is_blocked' => new sfWidgetFormInputCheckbox(),
            'blocked_limit' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'user_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('user_id')), 'empty_value' => $this->getObject()->get('user_id'), 'required' => false)),
            'email' => new sfValidatorString(array('max_length' => 80, 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 80, 'required' => false)),
            'surname1' => new sfValidatorString(array('max_length' => 80)),
            'surname2' => new sfValidatorString(array('max_length' => 80)),
            'active' => new sfValidatorString(array('max_length' => 5, 'required' => false)),
            'fecha_nac' => new sfValidatorDate(array('required' => false)),
            'validate' => new sfValidatorString(array('max_length' => 17, 'required' => false)),
            'image' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'direccion' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'numero' => new sfValidatorString(array('max_length' => 6, 'required' => false)),
            'piso' => new sfValidatorString(array('max_length' => 4, 'required' => false)),
            'puerta' => new sfValidatorString(array('max_length' => 6, 'required' => false)),
            'cp' => new sfValidatorPass(array('required' => false)),
            'telefono' => new sfValidatorString(array('max_length' => 12, 'required' => false)),
            'colaborador_nivel_uno_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ColaboradorNivelUno'), 'required' => false)),
            'colaborador_nivel_dos_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ColaboradorNivelDos'), 'required' => false)),
            'metodo_cobro_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MetodoCobro'), 'required' => false)),
            'rank' => new sfValidatorInteger(),
            'accumulated_points' => new sfValidatorInteger(),
            'hierarchy' => new sfValidatorInteger(array('required' => false)),
            'change_points' => new sfValidatorInteger(),
            'money' => new sfValidatorNumber(),
            'money_sum' => new sfValidatorNumber(),
            'road_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RoadType'), 'required' => false)),
            'states_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('States'))),
            'city_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'required' => false)),
            'sex' => new sfValidatorString(array('max_length' => 10)),
            'formacion_academica_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('FormacionAcademica'), 'required' => false)),
            'is_online' => new sfValidatorBoolean(array('required' => false)),
            'is_blocked' => new sfValidatorBoolean(array('required' => false)),
            'blocked_limit' => new sfValidatorInteger(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('sf_guard_user_profile[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'sfGuardUserProfile';
    }

}
