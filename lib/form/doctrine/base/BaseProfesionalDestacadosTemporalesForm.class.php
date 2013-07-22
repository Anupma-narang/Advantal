<?php

/**
 * ProfesionalDestacadosTemporales form base class.
 *
 * @method ProfesionalDestacadosTemporales getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfesionalDestacadosTemporalesForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'profesional_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesional'), 'add_empty' => false)),
            'tipo_tiempo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoTiempo'), 'add_empty' => false)),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'profesional_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profesional'))),
            'tipo_tiempo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoTiempo'))),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->widgetSchema->setNameFormat('profesional_destacados_temporales[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ProfesionalDestacadosTemporales';
    }

}
