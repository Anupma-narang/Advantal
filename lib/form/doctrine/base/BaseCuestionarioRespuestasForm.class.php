<?php

/**
 * CuestionarioRespuestas form base class.
 *
 * @method CuestionarioRespuestas getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCuestionarioRespuestasForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'respuesta1' => new sfWidgetFormInputText(),
            'respuesta2' => new sfWidgetFormInputText(),
            'respuesta3' => new sfWidgetFormInputText(),
            'respuesta4' => new sfWidgetFormInputText(),
            'respuesta5' => new sfWidgetFormInputText(),
            'respuesta6' => new sfWidgetFormInputText(),
            'respuesta7' => new sfWidgetFormInputText(),
            'respuesta8' => new sfWidgetFormInputText(),
            'respuesta9' => new sfWidgetFormInputText(),
            'respuesta10' => new sfWidgetFormInputText(),
            'respuesta11' => new sfWidgetFormInputText(),
            'respuesta12' => new sfWidgetFormInputText(),
            'respuesta13' => new sfWidgetFormTextarea(),
            'total' => new sfWidgetFormInputText(),
            'cuestionario_id' => new sfWidgetFormInputText(),
            'concurso_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Concurso'), 'add_empty' => true)),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
            'created_by' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'add_empty' => true)),
            'updated_by' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Updator'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'respuesta1' => new sfValidatorInteger(array('required' => false)),
            'respuesta2' => new sfValidatorInteger(array('required' => false)),
            'respuesta3' => new sfValidatorInteger(array('required' => false)),
            'respuesta4' => new sfValidatorInteger(array('required' => false)),
            'respuesta5' => new sfValidatorInteger(array('required' => false)),
            'respuesta6' => new sfValidatorInteger(array('required' => false)),
            'respuesta7' => new sfValidatorInteger(array('required' => false)),
            'respuesta8' => new sfValidatorInteger(array('required' => false)),
            'respuesta9' => new sfValidatorInteger(array('required' => false)),
            'respuesta10' => new sfValidatorInteger(array('required' => false)),
            'respuesta11' => new sfValidatorInteger(array('required' => false)),
            'respuesta12' => new sfValidatorInteger(array('required' => false)),
            'respuesta13' => new sfValidatorString(array('required' => false)),
            'total' => new sfValidatorInteger(array('required' => false)),
            'cuestionario_id' => new sfValidatorInteger(array('required' => false)),
            'concurso_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Concurso'), 'required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
            'created_by' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'required' => false)),
            'updated_by' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Updator'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('cuestionario_respuestas[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'CuestionarioRespuestas';
    }

}
