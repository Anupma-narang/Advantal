<?php

/**
 * CategoriaExcelencia form base class.
 *
 * @method CategoriaExcelencia getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCategoriaExcelenciaForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'nombre' => new sfWidgetFormInputText(),
            'valor_min' => new sfWidgetFormInputText(),
            'valor_max' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'nombre' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'valor_min' => new sfValidatorInteger(array('required' => false)),
            'valor_max' => new sfValidatorInteger(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('categoria_excelencia[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'CategoriaExcelencia';
    }

}
