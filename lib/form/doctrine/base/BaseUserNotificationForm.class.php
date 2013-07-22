<?php

/**
 * UserNotification form base class.
 *
 * @method UserNotification getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUserNotificationForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
            'colaborador_contribuye_value' => new sfWidgetFormInputCheckbox(),
            'concurso_empresa_value' => new sfWidgetFormInputCheckbox(),
            'concurso_empresa_nombre' => new sfWidgetFormInputText(),
            'concurso_empresa_provincia_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'add_empty' => true)),
            'concurso_empresa_ciudad_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => true)),
            'concurso_producto_value' => new sfWidgetFormInputCheckbox(),
            'concurso_producto_nombre' => new sfWidgetFormInputText(),
            'concurso_producto_marca' => new sfWidgetFormInputText(),
            'lista_blanca_value' => new sfWidgetFormInputCheckbox(),
            'lista_negra_value' => new sfWidgetFormInputCheckbox(),
            'publica_profesional_value' => new sfWidgetFormInputCheckbox(),
            'publica_recomend_disaprov_value' => new sfWidgetFormInputCheckbox(),
            'hash' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
            'colaborador_contribuye_value' => new sfValidatorBoolean(array('required' => false)),
            'concurso_empresa_value' => new sfValidatorBoolean(array('required' => false)),
            'concurso_empresa_nombre' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'concurso_empresa_provincia_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'required' => false)),
            'concurso_empresa_ciudad_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'required' => false)),
            'concurso_producto_value' => new sfValidatorBoolean(array('required' => false)),
            'concurso_producto_nombre' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'concurso_producto_marca' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'lista_blanca_value' => new sfValidatorBoolean(array('required' => false)),
            'lista_negra_value' => new sfValidatorBoolean(array('required' => false)),
            'publica_profesional_value' => new sfValidatorBoolean(array('required' => false)),
            'publica_recomend_disaprov_value' => new sfValidatorBoolean(array('required' => false)),
            'hash' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('user_notification[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'UserNotification';
    }

}
