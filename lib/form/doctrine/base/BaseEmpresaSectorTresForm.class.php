<?php

/**
 * EmpresaSectorTres form base class.
 *
 * @method EmpresaSectorTres getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEmpresaSectorTresForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'value' => new sfWidgetFormInputText(),
            'orden' => new sfWidgetFormInputText(),
            'image' => new sfWidgetFormInputText(),
            'empresa_sector_uno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorUno'), 'add_empty' => false)),
            'empresa_sector_dos_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorDos'), 'add_empty' => false)),
            'slug' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 100)),
            'value' => new sfValidatorString(array('max_length' => 60)),
            'orden' => new sfValidatorInteger(),
            'image' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'empresa_sector_uno_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorUno'))),
            'empresa_sector_dos_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorDos'))),
            'slug' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'EmpresaSectorTres', 'column' => array('slug', 'id', 'name')))
        );

        $this->widgetSchema->setNameFormat('empresa_sector_tres[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'EmpresaSectorTres';
    }

}
