<?php

/**
 * GiftRedemption form base class.
 *
 * @method GiftRedemption getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGiftRedemptionForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'surname1' => new sfWidgetFormInputText(),
            'surname2' => new sfWidgetFormInputText(),
            'road_type' => new sfWidgetFormInputText(),
            'address' => new sfWidgetFormInputText(),
            'number' => new sfWidgetFormInputText(),
            'floor' => new sfWidgetFormInputText(),
            'door' => new sfWidgetFormInputText(),
            'states_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'add_empty' => false)),
            'city_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => true)),
            'cp' => new sfWidgetFormInputText(),
            'contact_number' => new sfWidgetFormInputText(),
            'delivery_time' => new sfWidgetFormInputText(),
            'gift' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gift'), 'add_empty' => false)),
            'user' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
            'status' => new sfWidgetFormInputText(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorPass(array('required' => false)),
            'surname1' => new sfValidatorPass(array('required' => false)),
            'surname2' => new sfValidatorPass(array('required' => false)),
            'road_type' => new sfValidatorPass(),
            'address' => new sfValidatorPass(),
            'number' => new sfValidatorPass(),
            'floor' => new sfValidatorPass(array('required' => false)),
            'door' => new sfValidatorPass(array('required' => false)),
            'states_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('States'))),
            'city_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'required' => false)),
            'cp' => new sfValidatorPass(array('required' => false)),
            'contact_number' => new sfValidatorPass(array('required' => false)),
            'delivery_time' => new sfValidatorInteger(array('required' => false)),
            'gift' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gift'))),
            'user' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
            'status' => new sfValidatorInteger(array('required' => false)),
            'created_at' => new sfValidatorDateTime(array('required' => false)),
            'updated_at' => new sfValidatorDateTime(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('gift_redemption[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'GiftRedemption';
    }

}
