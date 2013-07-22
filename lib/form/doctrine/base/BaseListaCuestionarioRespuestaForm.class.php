<?php

/**
 * ListaCuestionarioRespuesta form base class.
 *
 * @method ListaCuestionarioRespuesta getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseListaCuestionarioRespuestaForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'respuesta' => new sfWidgetFormInputText(),
            'lista_cuestionario_pregunta_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pregunta'), 'add_empty' => true)),
            'lista_cuestionario_user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ListaCuestionarioUser'), 'add_empty' => true)),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
            'created_by' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'add_empty' => true)),
            'updated_by' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Updator'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'respuesta' => new sfValidatorPass(array('required' => false)),
            'lista_cuestionario_pregunta_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pregunta'), 'required' => false)),
            'lista_cuestionario_user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ListaCuestionarioUser'), 'required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
            'created_by' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'required' => false)),
            'updated_by' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Updator'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('lista_cuestionario_respuesta[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ListaCuestionarioRespuesta';
    }

}
