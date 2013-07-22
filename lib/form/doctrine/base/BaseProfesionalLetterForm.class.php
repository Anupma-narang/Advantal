<?php

/**
 * ProfesionalLetter form base class.
 *
 * @method ProfesionalLetter getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfesionalLetterForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'description' => new sfWidgetFormTextarea(),
            'plan_accion' => new sfWidgetFormTextarea(),
            'fecha_activacion' => new sfWidgetFormDate(),
            'fecha_referendum' => new sfWidgetFormDate(),
            'fecha_revision' => new sfWidgetFormInputText(),
            'fecha_deliberacion' => new sfWidgetFormInputText(),
            'fecha_observacion' => new sfWidgetFormInputText(),
            'fecha_cerrado' => new sfWidgetFormInputText(),
            'fecha_rechazado' => new sfWidgetFormInputText(),
            'fecha_nulo' => new sfWidgetFormInputText(),
            'is_first' => new sfWidgetFormInputCheckbox(),
            'revision_last_state_id' => new sfWidgetFormInputText(),
            'profesional_letter_estado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalLetterEstado'), 'add_empty' => false)),
            'profesional_letter_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalLetterType'), 'add_empty' => false)),
            'profesional_activa_desa_id' => new sfWidgetFormInputText(),
            'profesional_apro_despro_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalAproDespro'), 'add_empty' => false)),
            'profesional_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesional'), 'add_empty' => false)),
            'states_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'add_empty' => true)),
            'city_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => true)),
            'user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 100)),
            'description' => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
            'plan_accion' => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
            'fecha_activacion' => new sfValidatorDate(array('required' => false)),
            'fecha_referendum' => new sfValidatorDate(array('required' => false)),
            'fecha_revision' => new sfValidatorPass(array('required' => false)),
            'fecha_deliberacion' => new sfValidatorPass(array('required' => false)),
            'fecha_observacion' => new sfValidatorPass(array('required' => false)),
            'fecha_cerrado' => new sfValidatorPass(array('required' => false)),
            'fecha_rechazado' => new sfValidatorPass(array('required' => false)),
            'fecha_nulo' => new sfValidatorPass(array('required' => false)),
            'is_first' => new sfValidatorBoolean(array('required' => false)),
            'revision_last_state_id' => new sfValidatorInteger(array('required' => false)),
            'profesional_letter_estado_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalLetterEstado'))),
            'profesional_letter_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalLetterType'))),
            'profesional_activa_desa_id' => new sfValidatorInteger(),
            'profesional_apro_despro_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalAproDespro'))),
            'profesional_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profesional'))),
            'states_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'required' => false)),
            'city_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'required' => false)),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->widgetSchema->setNameFormat('profesional_letter[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ProfesionalLetter';
    }

}
