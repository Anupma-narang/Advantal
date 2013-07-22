<?php

/**
 * ColaboradorPuntosHistorico form base class.
 *
 * @method ColaboradorPuntosHistorico getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseColaboradorPuntosHistoricoForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
            'puntos' => new sfWidgetFormInputText(),
            'objeto_id' => new sfWidgetFormInputText(),
            'objeto' => new sfWidgetFormInputText(),
            'descripcion' => new sfWidgetFormInputText(),
            'parametros' => new sfWidgetFormTextarea(),
            'tipo_punto' => new sfWidgetFormInputText(),
            'status' => new sfWidgetFormInputCheckbox(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
            'puntos' => new sfValidatorNumber(array('required' => false)),
            'objeto_id' => new sfValidatorInteger(array('required' => false)),
            'objeto' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'descripcion' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'parametros' => new sfValidatorString(array('required' => false)),
            'tipo_punto' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'status' => new sfValidatorBoolean(array('required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->widgetSchema->setNameFormat('colaborador_puntos_historico[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'ColaboradorPuntosHistorico';
    }

}
