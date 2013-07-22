<?php

/**
 * CuestionarioPregunta form base class.
 *
 * @method CuestionarioPregunta getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCuestionarioPreguntaForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'label' => new sfWidgetFormInputText(),
            'type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CuestionarioValuesTypes'), 'add_empty' => false)),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'label' => new sfValidatorString(array('max_length' => 100)),
            'type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CuestionarioValuesTypes'))),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->widgetSchema->setNameFormat('cuestionario_pregunta[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'CuestionarioPregunta';
    }

}
