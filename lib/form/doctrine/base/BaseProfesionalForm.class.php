<?php

/**
 * Profesional form base class.
 *
 * @method Profesional getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfesionalForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'first_name' => new sfWidgetFormInputText(),
            'last_name_one' => new sfWidgetFormInputText(),
            'last_name_two' => new sfWidgetFormInputText(),
            'address' => new sfWidgetFormInputText(),
            'numero' => new sfWidgetFormInputText(),
            'piso' => new sfWidgetFormInputText(),
            'puerta' => new sfWidgetFormInputText(),
            'telefono' => new sfWidgetFormInputText(),
            'email' => new sfWidgetFormInputText(),
            'destacado' => new sfWidgetFormInputCheckbox(),
            'fecha_destacado' => new sfWidgetFormDate(),
            'fecha_activacion' => new sfWidgetFormDate(),
            'fecha_referendum' => new sfWidgetFormDate(),
            'fecha_revision' => new sfWidgetFormInputText(),
            'fecha_deliberacion' => new sfWidgetFormInputText(),
            'fecha_observacion' => new sfWidgetFormInputText(),
            'fecha_cerrado' => new sfWidgetFormInputText(),
            'fecha_rechazado' => new sfWidgetFormInputText(),
            'fecha_nulo' => new sfWidgetFormInputText(),
            'revision_last_state_id' => new sfWidgetFormInputText(),
            'profesional_estado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalEstado'), 'add_empty' => false)),
            'profesional_tipo_uno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoUno'), 'add_empty' => false)),
            'profesional_tipo_dos_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoDos'), 'add_empty' => false)),
            'profesional_tipo_tres_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoTres'), 'add_empty' => true)),
            'road_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoadType'), 'add_empty' => true)),
            'states_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'add_empty' => true)),
            'city_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => true)),
            'user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
            'active_reason' => new sfWidgetFormTextarea(),
            'dividendo' => new sfWidgetFormInputText(),
            'featured' => new sfWidgetFormInputCheckbox(),
            'featured_order' => new sfWidgetFormInputText(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
            'slug' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'first_name' => new sfValidatorString(array('max_length' => 100)),
            'last_name_one' => new sfValidatorString(array('max_length' => 100)),
            'last_name_two' => new sfValidatorString(array('max_length' => 100)),
            'address' => new sfValidatorString(array('max_length' => 70, 'required' => false)),
            'numero' => new sfValidatorString(array('max_length' => 6)),
            'piso' => new sfValidatorString(array('max_length' => 3, 'required' => false)),
            'puerta' => new sfValidatorString(array('max_length' => 6, 'required' => false)),
            'telefono' => new sfValidatorString(array('max_length' => 9, 'required' => false)),
            'email' => new sfValidatorString(array('max_length' => 70, 'required' => false)),
            'destacado' => new sfValidatorBoolean(array('required' => false)),
            'fecha_destacado' => new sfValidatorDate(array('required' => false)),
            'fecha_activacion' => new sfValidatorDate(array('required' => false)),
            'fecha_referendum' => new sfValidatorDate(array('required' => false)),
            'fecha_revision' => new sfValidatorPass(array('required' => false)),
            'fecha_deliberacion' => new sfValidatorPass(array('required' => false)),
            'fecha_observacion' => new sfValidatorPass(array('required' => false)),
            'fecha_cerrado' => new sfValidatorPass(array('required' => false)),
            'fecha_rechazado' => new sfValidatorPass(array('required' => false)),
            'fecha_nulo' => new sfValidatorPass(array('required' => false)),
            'revision_last_state_id' => new sfValidatorInteger(array('required' => false)),
            'profesional_estado_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalEstado'))),
            'profesional_tipo_uno_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoUno'))),
            'profesional_tipo_dos_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoDos'))),
            'profesional_tipo_tres_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoTres'), 'required' => false)),
            'road_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RoadType'), 'required' => false)),
            'states_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'required' => false)),
            'city_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'required' => false)),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
            'active_reason' => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
            'dividendo' => new sfValidatorInteger(array('required' => false)),
            'featured' => new sfValidatorBoolean(array('required' => false)),
            'featured_order' => new sfValidatorInteger(array('required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
            'slug' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'Profesional', 'column' => array('slug', 'id', 'first_name')))
        );

        $this->widgetSchema->setNameFormat('profesional[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Profesional';
    }

}
