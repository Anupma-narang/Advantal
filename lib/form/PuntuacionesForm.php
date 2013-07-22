<?php

class PuntuacionesForm extends sfFormSymfony
{
	public function setup()
	{
		$this->widgetSchema['puntos']=new sfWidgetFormInput();
		$this->widgetSchema["type"]=new sfWidgetFormInputHidden();
		$this->setDefault("type",sfContext::getInstance()->getRequest()->getParameter("type"));
		$this->widgetSchema->setNameFormat('puntuar[%s]');
		$this->validatorSchema["puntos"]=new sfValidatorInteger();
		$this->validatorSchema["type"]=new sfValidatorPass();
		parent::setup();

	}
}