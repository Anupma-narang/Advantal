<?php

/**
 * MesaredondaReferendum form base class.
 *
 * @method MesaredondaReferendum getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMesaredondaReferendumForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'mesa_redonda_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesaRedonda'), 'add_empty' => false)),
            'mesaredonda_ponencia_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesaredondaPonencia'), 'add_empty' => false)),
            'value' => new sfWidgetFormInputText(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'mesa_redonda_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MesaRedonda'))),
            'mesaredonda_ponencia_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MesaredondaPonencia'))),
            'value' => new sfValidatorInteger(array('required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->widgetSchema->setNameFormat('mesaredonda_referendum[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'MesaredondaReferendum';
    }

}
