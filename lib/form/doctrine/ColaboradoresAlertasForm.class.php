<?php

/**
 * ColaboradoresAlertas form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ColaboradoresAlertasForm extends BaseAlertasForm {

    public function configure() {
        unset($this['created_at'], $this['updated_at']);
        //set widget
        $this->widgetSchema['type'] = new sfWidgetFormInputText(array(), array('maxlength' => 40, 'class' => 'tamano_20_c'));
        $this->widgetSchema['message'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_40_c'));
        //   $this->widgetSchema['user_related_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => 'Selecciona Usuario'));
        //user_id
        $this->widgetSchema['user_related_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['user_related_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser')));

        //username
        $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array("default" => (!$this->isNew() ? $this->getObject()->getSfGuardUser()->getUsername() : "")), array('id' => 'alertas_user_related', 'maxlength' => 25, 'style' => 'width:176px;'));
        $this->validatorSchema['user_name'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'username'), array('required' => 'Necesitas seleccionar un Usuario.', 'invalid' => 'Ese Usuario no es válido.'));

        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->validatorSchema->setOption('filter_extra_fields', false);



        //set validator
        $this->validatorSchema['type'] = new sfValidatorString(array('required' => true), array('required' => 'Necesitas incluir un tipo de alerta.'));
        $this->validatorSchema['message'] = new sfValidatorString(array('required' => true), array('required' => 'Necesitas incluir una descripción.'));
        $this->validatorSchema['entity'] = new sfValidatorPass();

        $this->setDefault("entity", 2);
    }

}
