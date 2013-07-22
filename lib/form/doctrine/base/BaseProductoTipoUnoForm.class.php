<?php

/**
 * ProductoTipoUno form base class.
 *
 * @method ProductoTipoUno getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProductoTipoUnoForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'orden' => new sfWidgetFormInputText(),
            'name' => new sfWidgetFormInputText(),
            'image' => new sfWidgetFormInputText(),
            'slug' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'orden' => new sfValidatorInteger(),
            'name' => new sfValidatorString(array('max_length' => 100)),
            'image' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'slug' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'ProductoTipoUno', 'column' => array('slug', 'id', 'name')))
        );

        $this->widgetSchema->setNameFormat('producto_tipo_uno[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ProductoTipoUno';
    }

}
