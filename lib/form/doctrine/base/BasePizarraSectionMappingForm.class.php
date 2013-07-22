<?php

/**
 * PizarraSectionMapping form base class.
 *
 * @method PizarraSectionMapping getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePizarraSectionMappingForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'pizarra_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pizarra'), 'add_empty' => false)),
            'pizarra_section_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PizarraSection'), 'add_empty' => false)),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'pizarra_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pizarra'))),
            'pizarra_section_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PizarraSection'))),
            'created_at' => new sfValidatorDateTime(array('required' => false)),
            'updated_at' => new sfValidatorDateTime(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('pizarra_section_mapping[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'PizarraSectionMapping';
    }

}
