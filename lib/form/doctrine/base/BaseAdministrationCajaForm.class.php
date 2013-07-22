<?php

/**
 * AdministrationCaja form base class.
 *
 * @method AdministrationCaja getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdministrationCajaForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'expiry_date' => new sfWidgetFormInputText(),
            'points_per_cent' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'expiry_date' => new sfValidatorPass(),
            'points_per_cent' => new sfValidatorInteger(),
        ));

        $this->widgetSchema->setNameFormat('administration_caja[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'AdministrationCaja';
    }

}
