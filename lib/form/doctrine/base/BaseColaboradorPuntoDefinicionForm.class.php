<?php

/**
 * ColaboradorPuntoDefinicion form base class.
 *
 * @method ColaboradorPuntoDefinicion getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseColaboradorPuntoDefinicionForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'descripcion' => new sfWidgetFormInputText(),
            'puntos' => new sfWidgetFormInputText(),
            'is_automatic' => new sfWidgetFormInputCheckbox(),
            'codigo' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'descripcion' => new sfValidatorString(array('max_length' => 255)),
            'puntos' => new sfValidatorInteger(),
            'is_automatic' => new sfValidatorBoolean(array('required' => false)),
            'codigo' => new sfValidatorString(array('max_length' => 255)),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'ColaboradorPuntoDefinicion', 'column' => array('codigo')))
        );

        $this->widgetSchema->setNameFormat('colaborador_punto_definicion[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ColaboradorPuntoDefinicion';
    }

}
