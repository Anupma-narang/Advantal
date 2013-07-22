<?php

/**
 * KpiEmpresaProducto form base class.
 *
 * @method KpiEmpresaProducto getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseKpiEmpresaProductoForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'kpi_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Kpi'), 'add_empty' => true)),
            'empresa_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Empresa'), 'add_empty' => true)),
            'producto_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
            'suma_valores' => new sfWidgetFormInputText(),
            'numero_valores' => new sfWidgetFormInputText(),
            'nombre' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'kpi_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Kpi'), 'required' => false)),
            'empresa_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Empresa'), 'required' => false)),
            'producto_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'required' => false)),
            'suma_valores' => new sfValidatorInteger(array('required' => false)),
            'numero_valores' => new sfValidatorInteger(array('required' => false)),
            'nombre' => new sfValidatorString(array('max_length' => 255)),
        ));

        $this->widgetSchema->setNameFormat('kpi_empresa_producto[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'KpiEmpresaProducto';
    }

}
