<?php

/**
 * Contribucion form base class.
 *
 * @method Contribucion getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContribucionForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'concurso_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Concurso'), 'add_empty' => false)),
            'contribucion_estado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContribucionEstado'), 'add_empty' => false)),
            'incidencia' => new sfWidgetFormTextarea(),
            'plan_accion' => new sfWidgetFormTextarea(),
            'resumen' => new sfWidgetFormTextarea(),
            'principal' => new sfWidgetFormInputCheckbox(),
            'numero' => new sfWidgetFormInputText(),
            'user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
            'destacado' => new sfWidgetFormInputCheckbox(),
            'fecha_destacado' => new sfWidgetFormDate(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
            'slug' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 100)),
            'concurso_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Concurso'))),
            'contribucion_estado_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ContribucionEstado'))),
            'incidencia' => new sfValidatorString(array('max_length' => 2147483647)),
            'plan_accion' => new sfValidatorString(array('max_length' => 2147483647)),
            'resumen' => new sfValidatorString(array('max_length' => 2147483647)),
            'principal' => new sfValidatorBoolean(),
            'numero' => new sfValidatorInteger(array('required' => false)),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
            'destacado' => new sfValidatorBoolean(),
            'fecha_destacado' => new sfValidatorDate(array('required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
            'slug' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorAnd(array(
            new sfValidatorDoctrineUnique(array('model' => 'Contribucion', 'column' => array('concurso_id', 'numero'))),
            new sfValidatorDoctrineUnique(array('model' => 'Contribucion', 'column' => array('slug', 'id', 'name'))),
                ))
        );

        $this->widgetSchema->setNameFormat('contribucion[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Contribucion';
    }

}
