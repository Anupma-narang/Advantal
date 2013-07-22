<?php

/**
 * PdCarta form base class.
 *
 * @method PdCarta getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePdCartaForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'description' => new sfWidgetFormTextarea(),
            'plan_accion' => new sfWidgetFormTextarea(),
            'pd_estado_carta_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PdEstadoCarta'), 'add_empty' => false)),
            'pd_activa_desa_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PdActivaDesa'), 'add_empty' => false)),
            'pd_apro_despro_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PdAproDespro'), 'add_empty' => false)),
            'pd_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pd'), 'add_empty' => false)),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 100)),
            'description' => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
            'plan_accion' => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
            'pd_estado_carta_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PdEstadoCarta'))),
            'pd_activa_desa_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PdActivaDesa'))),
            'pd_apro_despro_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PdAproDespro'))),
            'pd_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pd'))),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->widgetSchema->setNameFormat('pd_carta[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'PdCarta';
    }

}
