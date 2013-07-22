<?php

/**
 * ProfesionalGoogleMap form base class.
 *
 * @method ProfesionalGoogleMap getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfesionalGoogleMapForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'address' => new sfWidgetFormInputText(),
            'lat' => new sfWidgetFormInputText(),
            'lng' => new sfWidgetFormInputText(),
            'zoom' => new sfWidgetFormInputText(),
            'marker_lat' => new sfWidgetFormInputText(),
            'marker_lng' => new sfWidgetFormInputText(),
            'profesional_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesional'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'address' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'lat' => new sfValidatorNumber(array('required' => false)),
            'lng' => new sfValidatorNumber(array('required' => false)),
            'zoom' => new sfValidatorInteger(array('required' => false)),
            'marker_lat' => new sfValidatorNumber(array('required' => false)),
            'marker_lng' => new sfValidatorNumber(array('required' => false)),
            'profesional_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profesional'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('profesional_google_map[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ProfesionalGoogleMap';
    }

}
