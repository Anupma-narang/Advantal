<?php

/**
 * ProductCaseStudy form base class.
 *
 * @method ProductCaseStudy getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProductCaseStudyForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'status' => new sfWidgetFormInputText(),
            'name' => new sfWidgetFormInputText(),
            'marca' => new sfWidgetFormInputText(),
            'modelo' => new sfWidgetFormInputText(),
            'producto_tipo_uno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoUno'), 'add_empty' => true)),
            'producto_tipo_dos_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoDos'), 'add_empty' => true)),
            'producto_tipo_tres_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoTres'), 'add_empty' => true)),
            'description' => new sfWidgetFormInputText(),
            'summary' => new sfWidgetFormInputText(),
            'file1' => new sfWidgetFormInputText(),
            'file2' => new sfWidgetFormInputText(),
            'file3' => new sfWidgetFormInputText(),
            'file4' => new sfWidgetFormInputText(),
            'logo' => new sfWidgetFormInputText(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'status' => new sfValidatorInteger(array('required' => false)),
            'name' => new sfValidatorString(array('max_length' => 70)),
            'marca' => new sfValidatorString(array('max_length' => 70, 'required' => false)),
            'modelo' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
            'producto_tipo_uno_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoUno'), 'required' => false)),
            'producto_tipo_dos_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoDos'), 'required' => false)),
            'producto_tipo_tres_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoTres'), 'required' => false)),
            'description' => new sfValidatorPass(array('required' => false)),
            'summary' => new sfValidatorPass(array('required' => false)),
            'file1' => new sfValidatorPass(array('required' => false)),
            'file2' => new sfValidatorPass(array('required' => false)),
            'file3' => new sfValidatorPass(array('required' => false)),
            'file4' => new sfValidatorPass(array('required' => false)),
            'logo' => new sfValidatorPass(array('required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->widgetSchema->setNameFormat('product_case_study[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ProductCaseStudy';
    }

}
