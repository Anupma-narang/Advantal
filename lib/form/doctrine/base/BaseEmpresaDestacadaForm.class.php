<?php

/**
 * EmpresaDestacada form base class.
 *
 * @method EmpresaDestacada getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEmpresaDestacadaForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'empresa_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Empresa'), 'add_empty' => true)),
            'empresa_sector_uno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorUno'), 'add_empty' => true)),
            'empresa_sector_dos_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorDos'), 'add_empty' => true)),
            'empresa_sector_tres_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorTres'), 'add_empty' => true)),
            'localidad_id' => new sfWidgetFormInputText(),
            'states_id' => new sfWidgetFormInputText(),
            'rank' => new sfWidgetFormInputText(),
            'combinado' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'empresa_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Empresa'), 'required' => false)),
            'empresa_sector_uno_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorUno'), 'required' => false)),
            'empresa_sector_dos_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorDos'), 'required' => false)),
            'empresa_sector_tres_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorTres'), 'required' => false)),
            'localidad_id' => new sfValidatorInteger(array('required' => false)),
            'states_id' => new sfValidatorInteger(array('required' => false)),
            'rank' => new sfValidatorInteger(array('required' => false)),
            'combinado' => new sfValidatorInteger(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('empresa_destacada[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'EmpresaDestacada';
    }

}
