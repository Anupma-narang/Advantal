<?php

/**
 * Gift form base class.
 *
 * @method Gift getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGiftForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'image' => new sfWidgetFormInputText(),
            'require_points' => new sfWidgetFormInputText(),
            'hierarchy' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Jerarquia'), 'add_empty' => false)),
            'features' => new sfWidgetFormInputText(),
            'orden' => new sfWidgetFormInputText(),
            'featured' => new sfWidgetFormInputCheckbox(),
            'featured_order' => new sfWidgetFormInputText(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorPass(),
            'image' => new sfValidatorPass(),
            'require_points' => new sfValidatorInteger(),
            'hierarchy' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Jerarquia'))),
            'features' => new sfValidatorPass(),
            'orden' => new sfValidatorInteger(array('required' => false)),
            'featured' => new sfValidatorBoolean(array('required' => false)),
            'featured_order' => new sfValidatorInteger(array('required' => false)),
            'created_at' => new sfValidatorDateTime(array('required' => false)),
            'updated_at' => new sfValidatorDateTime(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('gift[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Gift';
    }

}
