<?php

/**
 * ConcursosDestacadosTemporales form base class.
 *
 * @method ConcursosDestacadosTemporales getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseConcursosDestacadosTemporalesForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'concurso_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Concurso'), 'add_empty' => false)),
            'tipo_tiempo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoTiempo'), 'add_empty' => false)),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'concurso_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Concurso'))),
            'tipo_tiempo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoTiempo'))),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->widgetSchema->setNameFormat('concursos_destacados_temporales[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ConcursosDestacadosTemporales';
    }

}
