<?php

/**
 * metodo_paypal form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class metodo_paypalForm extends Basemetodo_paypalForm {

    public function configure() {
        unset($this['user_id']);

        $this->widgetSchema['tipo_documento_id'] = new sfWidgetFormDoctrineChoice(
                array(
            'model' => $this->getRelatedModelName('TipoDocumento'),
            'add_empty' => 'Selecciona tu documento'));
        $this->validatorSchema['tipo_documento_id'] = new sfValidatorDoctrineChoice(
                array(
            'model' => $this->getRelatedModelName('TipoDocumento'),
            'required' => true), array('required' => 'No has seleccionado tu tipo de documento.'));

        $this->widgetSchema['nifnie'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_9_c', 'maxlength' => 9));
        $this->validatorSchema['nifnie'] = new sfValidatorAnd(array(
            new sfValidatorString(
                    array(
                'max_length' => 12,
                'required' => true), array()),
            new sfValidatorRegex(array('pattern' => "/^((([A-Z]|[a-z])\d{8})|(\d{8}([A-Z]|[a-z])))$/"))
        ));
        $this->validatorSchema['nifnie']->setMessages(array('required' => 'No has introducido tu NIF ó NIE.',
            'invalid' => 'Ese NIF o NIE no es válido.'));

        $this->widgetSchema['usuario'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->validatorSchema['usuario'] = new sfValidatorAnd(array(
            new sfValidatorString(
                    array(
                'max_length' => 70,
                'trim' => true,
                'min_length' => 2,
                'max_length' => 32,
                'required' => true), array()),
            new sfValidatorEmail()
                //new sfValidatorRegex(array('pattern' =>"/^[a-z\s\_áéíóúAÉÍÓÚÑñ\']+$/i"),array())
        ));
        $this->validatorSchema['usuario']->setMessages(array('required' => 'No has incluido tu Usuario en Paypal.', 'invalid' => 'Ese Usuario en Paypal no es válido'));


        $this->widgetSchema->setLabels(array(
            'tipo_documento_id' => 'Tipo de documento*',
            'nifnie' => 'Nº de documento*',
            'usuario' => 'Mi usuario en Paypal*'
        ));
    }

}