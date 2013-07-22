<?php

class sfApplyResetRequestForm extends sfForm
{
  public function configure()
  {
    parent::configure();

    $this->setWidget('username_or_email',
      new sfWidgetFormInput(
        array(), array('class' => 'tamano_32_c', 'maxlength' => 70)));

    $this->setValidator('username_or_email',
          new sfValidatorAnd(
            array(
              new sfValidatorString(array('required' => true,
                'trim' => true,
                'min_length' => 4,
                'max_length' => 700)),
          	new sfValidatorEmail(array('required' => true)))
    ));
    
    $this->validatorSchema['username_or_email']->setMessages(array('required'=>'Necesitas introducir tu correo electrónico.', 'invalid' => 'Ese correo electrónico no es válido.'));
            
    $this->widgetSchema->setNameFormat('sfApplyResetRequest[%s]');
    $this->widgetSchema->setFormFormatterName('list');        
  }

}

