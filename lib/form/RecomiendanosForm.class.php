<?php

class RecomiendanosForm extends sfForm {

  public function configure() {

    $usuario = $this->getOption('usuario');

    $this->setWidgets(array(
        'nombre' => new sfWidgetFormInput(array('default' => ($usuario->isAuthenticated()) ? $usuario : '')),
        'apellido1' => new sfWidgetFormInput(array('default' => ($usuario->isAuthenticated()) ? $usuario->getProfile()->getSurname1() : '')),
        'apellido2' => new sfWidgetFormInput(array('default' => ($usuario->isAuthenticated()) ? $usuario->getProfile()->getSurname2() : '')),
        'email' => new sfWidgetFormInput(array('default' => ($usuario->isAuthenticated()) ? $usuario->getGuardUser()->getEmailAddress() : '')),
    ));

    $this->widgetSchema->setNameFormat('recomienda[%s]');

    $this->setValidators(array(
        'nombre' => new sfValidatorString(),
        'apellido1' => new sfValidatorString(array('required' => true)),
        'apellido2' => new sfValidatorString(array('required' => true)),
        'email' => new sfValidatorString(array('required' => true)),
        
    ));

    $this->widgetSchema->setLabels(array(
        'nombre' => 'Tu nombre',
        'apellido1' => 'Tu apellido 1',
        'apellido2' => 'Tu apellido 2',
        'email' => 'Tu correo electrónico',
        
    ));
  }

}
