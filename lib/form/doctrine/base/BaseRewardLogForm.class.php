<?php

/**
 * RewardLog form base class.
 *
 * @method RewardLog getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRewardLogForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
            'hierarchy' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Jerarquia'), 'add_empty' => true)),
            'cash' => new sfWidgetFormInputText(),
            'gift' => new sfWidgetFormInputText(),
            'descroption' => new sfWidgetFormInputText(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
            'hierarchy' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Jerarquia'), 'required' => false)),
            'cash' => new sfValidatorNumber(array('required' => false)),
            'gift' => new sfValidatorPass(array('required' => false)),
            'descroption' => new sfValidatorPass(array('required' => false)),
            'created_at' => new sfValidatorDateTime(array('required' => false)),
            'updated_at' => new sfValidatorDateTime(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('reward_log[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'RewardLog';
    }

}
