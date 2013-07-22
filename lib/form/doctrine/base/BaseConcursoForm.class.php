<?php

/**
 * Concurso form base class.
 *
 * @method Concurso getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseConcursoForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'incidencia' => new sfWidgetFormTextarea(),
            'concurso_estado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoEstado'), 'add_empty' => false)),
            'concurso_tipo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoTipo'), 'add_empty' => false)),
            'empresa_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Empresa'), 'add_empty' => true)),
            'producto_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
            'concurso_categoria_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCategoria'), 'add_empty' => true)),
            'fecha_activacion' => new sfWidgetFormDate(),
            'fecha_referendum' => new sfWidgetFormDate(),
            'fecha_revision' => new sfWidgetFormInputText(),
            'fecha_deliberacion' => new sfWidgetFormInputText(),
            'fecha_observacion' => new sfWidgetFormInputText(),
            'fecha_cerrado' => new sfWidgetFormInputText(),
            'fecha_rechazado' => new sfWidgetFormInputText(),
            'fecha_nulo' => new sfWidgetFormInputText(),
            'revision_last_state_id' => new sfWidgetFormInputText(),
            'road_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoadType'), 'add_empty' => true)),
            'states_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'add_empty' => true)),
            'city_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => true)),
            'concurso_address' => new sfWidgetFormInputText(),
            'concurso_numero' => new sfWidgetFormInputText(),
            'concurso_piso' => new sfWidgetFormInputText(),
            'concurso_puerta' => new sfWidgetFormInputText(),
            'user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
            'destacado' => new sfWidgetFormInputCheckbox(),
            'fecha_destacado' => new sfWidgetFormDate(),
            'cuestionario_id' => new sfWidgetFormInputText(),
            'cuestionario_total' => new sfWidgetFormInputText(),
            'featured' => new sfWidgetFormInputCheckbox(),
            'featured_order' => new sfWidgetFormInputText(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
            'slug' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 100)),
            'incidencia' => new sfValidatorString(array('max_length' => 2147483647)),
            'concurso_estado_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoEstado'))),
            'concurso_tipo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoTipo'))),
            'empresa_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Empresa'), 'required' => false)),
            'producto_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => false)),
            'concurso_categoria_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCategoria'), 'required' => false)),
            'fecha_activacion' => new sfValidatorDate(array('required' => false)),
            'fecha_referendum' => new sfValidatorDate(array('required' => false)),
            'fecha_revision' => new sfValidatorPass(array('required' => false)),
            'fecha_deliberacion' => new sfValidatorPass(array('required' => false)),
            'fecha_observacion' => new sfValidatorPass(array('required' => false)),
            'fecha_cerrado' => new sfValidatorPass(array('required' => false)),
            'fecha_rechazado' => new sfValidatorPass(array('required' => false)),
            'fecha_nulo' => new sfValidatorPass(array('required' => false)),
            'revision_last_state_id' => new sfValidatorInteger(array('required' => false)),
            'road_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RoadType'), 'required' => false)),
            'states_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'required' => false)),
            'city_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'required' => false)),
            'concurso_address' => new sfValidatorString(array('max_length' => 250, 'required' => false)),
            'concurso_numero' => new sfValidatorString(array('max_length' => 6)),
            'concurso_piso' => new sfValidatorString(array('max_length' => 4, 'required' => false)),
            'concurso_puerta' => new sfValidatorString(array('max_length' => 6, 'required' => false)),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
            'destacado' => new sfValidatorBoolean(array('required' => false)),
            'fecha_destacado' => new sfValidatorDate(array('required' => false)),
            'cuestionario_id' => new sfValidatorInteger(array('required' => false)),
            'cuestionario_total' => new sfValidatorInteger(array('required' => false)),
            'featured' => new sfValidatorBoolean(array('required' => false)),
            'featured_order' => new sfValidatorInteger(array('required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
            'slug' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'Concurso', 'column' => array('slug', 'id', 'name')))
        );

        $this->widgetSchema->setNameFormat('concurso[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Concurso';
    }

}
