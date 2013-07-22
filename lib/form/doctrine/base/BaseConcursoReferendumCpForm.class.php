<?php

/**
 * ConcursoReferendumCp form base class.
 *
 * @method ConcursoReferendumCp getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseConcursoReferendumCpForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'concurso_cp_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCp'), 'add_empty' => false)),
            'contribucion_cp_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContribucionCp'), 'add_empty' => false)),
            'value' => new sfWidgetFormInputText(),
            'user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'concurso_cp_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCp'))),
            'contribucion_cp_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ContribucionCp'))),
            'value' => new sfValidatorInteger(),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->widgetSchema->setNameFormat('concurso_referendum_cp[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ConcursoReferendumCp';
    }

}
