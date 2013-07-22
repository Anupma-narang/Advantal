<?php

/**
 * ProfesionalTipoDos form base class.
 *
 * @method ProfesionalTipoDos getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfesionalTipoDosForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'value' => new sfWidgetFormInputText(),
            'orden' => new sfWidgetFormInputText(),
            'image' => new sfWidgetFormInputText(),
            'profesional_tipo_uno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoUno'), 'add_empty' => false)),
            'slug' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 70)),
            'value' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'orden' => new sfValidatorInteger(),
            'image' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'profesional_tipo_uno_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoUno'))),
            'slug' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'ProfesionalTipoDos', 'column' => array('slug', 'id', 'name')))
        );

        $this->widgetSchema->setNameFormat('profesional_tipo_dos[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ProfesionalTipoDos';
    }

}
