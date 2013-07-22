<?php

/**
 * ListaCuestionario form base class.
 *
 * @method ListaCuestionario getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseListaCuestionarioForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'nombre' => new sfWidgetFormInputText(),
            'tipo' => new sfWidgetFormInputText(),
            'empresa_sector_uno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorUno'), 'add_empty' => true)),
            'empresa_sector_dos_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorDos'), 'add_empty' => true)),
            'empresa_sector_tres_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorTres'), 'add_empty' => true)),
            'producto_tipo_uno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoUno'), 'add_empty' => true)),
            'producto_tipo_dos_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoDos'), 'add_empty' => true)),
            'producto_tipo_tres_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoTres'), 'add_empty' => true)),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'nombre' => new sfValidatorString(array('max_length' => 255)),
            'tipo' => new sfValidatorString(array('max_length' => 10, 'required' => false)),
            'empresa_sector_uno_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorUno'), 'required' => false)),
            'empresa_sector_dos_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorDos'), 'required' => false)),
            'empresa_sector_tres_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorTres'), 'required' => false)),
            'producto_tipo_uno_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoUno'), 'required' => false)),
            'producto_tipo_dos_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoDos'), 'required' => false)),
            'producto_tipo_tres_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoTres'), 'required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->widgetSchema->setNameFormat('lista_cuestionario[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ListaCuestionario';
    }

}
