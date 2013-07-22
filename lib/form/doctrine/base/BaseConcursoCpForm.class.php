<?php

/**
 * ConcursoCp form base class.
 *
 * @method ConcursoCp getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseConcursoCpForm extends BaseFormDoctrine {

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
            'road_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoadType'), 'add_empty' => true)),
            'states_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'add_empty' => true)),
            'city_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => true)),
            'concurso_address' => new sfWidgetFormInputText(),
            'concurso_code' => new sfWidgetFormInputText(),
            'concurso_otra' => new sfWidgetFormInputText(),
            'mail' => new sfWidgetFormInputText(),
            'user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
            'destacado' => new sfWidgetFormInputCheckbox(),
            'fecha_destacado' => new sfWidgetFormDate(),
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
            'road_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RoadType'), 'required' => false)),
            'states_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'required' => false)),
            'city_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'required' => false)),
            'concurso_address' => new sfValidatorString(array('max_length' => 250, 'required' => false)),
            'concurso_code' => new sfValidatorString(array('max_length' => 5, 'required' => false)),
            'concurso_otra' => new sfValidatorString(array('max_length' => 9, 'required' => false)),
            'mail' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
            'destacado' => new sfValidatorBoolean(array('required' => false)),
            'fecha_destacado' => new sfValidatorDate(array('required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
            'slug' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'ConcursoCp', 'column' => array('slug', 'id', 'name')))
        );

        $this->widgetSchema->setNameFormat('concurso_cp[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ConcursoCp';
    }

}
