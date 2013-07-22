<?php

/**
 * ConcursoRevision form base class.
 *
 * @method ConcursoRevision getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseConcursoRevisionForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'concurso_id' => new sfWidgetFormInputText(),
            'fecha_inicio' => new sfWidgetFormDate(),
            'fecha_fin' => new sfWidgetFormDate(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'concurso_id' => new sfValidatorInteger(),
            'fecha_inicio' => new sfValidatorDate(),
            'fecha_fin' => new sfValidatorDate(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('concurso_revision[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ConcursoRevision';
    }

}
