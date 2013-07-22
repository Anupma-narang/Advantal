<?php

/**
 * MetodoBanco form base class.
 *
 * @method MetodoBanco getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMetodoBancoForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
            'tipo_documento_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'), 'add_empty' => false)),
            'nifnie' => new sfWidgetFormInputText(),
            'titular_name' => new sfWidgetFormInputText(),
            'surname1' => new sfWidgetFormInputText(),
            'surname2' => new sfWidgetFormInputText(),
            'cuenta_entidad' => new sfWidgetFormInputText(),
            'cuenta_oficina' => new sfWidgetFormInputText(),
            'cuenta_dc' => new sfWidgetFormInputText(),
            'cuenta_numero' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
            'tipo_documento_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'))),
            'nifnie' => new sfValidatorString(array('max_length' => 12)),
            'titular_name' => new sfValidatorString(array('max_length' => 80)),
            'surname1' => new sfValidatorString(array('max_length' => 80)),
            'surname2' => new sfValidatorString(array('max_length' => 80)),
            'cuenta_entidad' => new sfValidatorString(array('max_length' => 4)),
            'cuenta_oficina' => new sfValidatorString(array('max_length' => 4)),
            'cuenta_dc' => new sfValidatorString(array('max_length' => 2)),
            'cuenta_numero' => new sfValidatorString(array('max_length' => 10)),
        ));

        $this->widgetSchema->setNameFormat('metodo_banco[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'MetodoBanco';
    }

}
