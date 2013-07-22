<?php

/**
 * ContribucionCp form base class.
 *
 * @method ContribucionCp getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContribucionCpForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'concurso_cp_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCp'), 'add_empty' => false)),
            'contribucion_estado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContribucionEstado'), 'add_empty' => false)),
            'incidencia' => new sfWidgetFormTextarea(),
            'plan_accion' => new sfWidgetFormTextarea(),
            'resumen' => new sfWidgetFormTextarea(),
            'principal' => new sfWidgetFormInputCheckbox(),
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
            'concurso_cp_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCp'))),
            'contribucion_estado_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ContribucionEstado'))),
            'incidencia' => new sfValidatorString(array('max_length' => 2147483647)),
            'plan_accion' => new sfValidatorString(array('max_length' => 2147483647)),
            'resumen' => new sfValidatorString(array('max_length' => 2147483647)),
            'principal' => new sfValidatorBoolean(),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
            'destacado' => new sfValidatorBoolean(),
            'fecha_destacado' => new sfValidatorDate(array('required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
            'slug' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'ContribucionCp', 'column' => array('slug', 'id', 'name')))
        );

        $this->widgetSchema->setNameFormat('contribucion_cp[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ContribucionCp';
    }

}
