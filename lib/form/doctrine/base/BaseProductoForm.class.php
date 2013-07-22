<?php

/**
 * Producto form base class.
 *
 * @method Producto getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProductoForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'marca' => new sfWidgetFormInputText(),
            'modelo' => new sfWidgetFormInputText(),
            'valida' => new sfWidgetFormInputText(),
            'lista' => new sfWidgetFormInputText(),
            'dividendo' => new sfWidgetFormInputText(),
            'divisor' => new sfWidgetFormInputText(),
            'comentario_inicial' => new sfWidgetFormInputText(),
            'lista_cuestionario_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cuestionario'), 'add_empty' => true)),
            'texto_lista_negra' => new sfWidgetFormInputText(),
            'persona_contacto' => new sfWidgetFormInputText(),
            'email' => new sfWidgetFormInputText(),
            'telefono' => new sfWidgetFormInputText(),
            'producto_tipo_uno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoUno'), 'add_empty' => true)),
            'producto_tipo_dos_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoDos'), 'add_empty' => true)),
            'producto_tipo_tres_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoTres'), 'add_empty' => true)),
            'concurso_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('concursoDestacado'), 'add_empty' => true)),
            'featured' => new sfWidgetFormInputCheckbox(),
            'featured_order' => new sfWidgetFormInputText(),
            'slug' => new sfWidgetFormInputText(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 100)),
            'marca' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'modelo' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'valida' => new sfValidatorInteger(array('required' => false)),
            'lista' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'dividendo' => new sfValidatorInteger(array('required' => false)),
            'divisor' => new sfValidatorInteger(array('required' => false)),
            'comentario_inicial' => new sfValidatorPass(array('required' => false)),
            'lista_cuestionario_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cuestionario'), 'required' => false)),
            'texto_lista_negra' => new sfValidatorPass(array('required' => false)),
            'persona_contacto' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'email' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'telefono' => new sfValidatorString(array('max_length' => 9, 'required' => false)),
            'producto_tipo_uno_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoUno'), 'required' => false)),
            'producto_tipo_dos_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoDos'), 'required' => false)),
            'producto_tipo_tres_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoTres'), 'required' => false)),
            'concurso_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('concursoDestacado'), 'required' => false)),
            'featured' => new sfValidatorBoolean(array('required' => false)),
            'featured_order' => new sfValidatorInteger(array('required' => false)),
            'slug' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'Producto', 'column' => array('slug')))
        );

        $this->widgetSchema->setNameFormat('producto[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Producto';
    }

}
