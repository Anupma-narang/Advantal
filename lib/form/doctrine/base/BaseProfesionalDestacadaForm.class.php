<?php

/**
 * ProfesionalDestacada form base class.
 *
 * @method ProfesionalDestacada getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfesionalDestacadaForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'profesional_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesional'), 'add_empty' => true)),
            'profesional_tipo_uno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoUno'), 'add_empty' => true)),
            'profesional_tipo_dos_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoDos'), 'add_empty' => true)),
            'profesional_tipo_tres_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoTres'), 'add_empty' => true)),
            'city_id' => new sfWidgetFormInputText(),
            'states_id' => new sfWidgetFormInputText(),
            'rank' => new sfWidgetFormInputText(),
            'combinado' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'profesional_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profesional'), 'required' => false)),
            'profesional_tipo_uno_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoUno'), 'required' => false)),
            'profesional_tipo_dos_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoDos'), 'required' => false)),
            'profesional_tipo_tres_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoTres'), 'required' => false)),
            'city_id' => new sfValidatorInteger(array('required' => false)),
            'states_id' => new sfValidatorInteger(array('required' => false)),
            'rank' => new sfValidatorInteger(array('required' => false)),
            'combinado' => new sfValidatorInteger(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('profesional_destacada[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ProfesionalDestacada';
    }

}
