<?php

class ContactProfesionalSimpleForm extends sfFormSymfony
{
	public function setup()
	{
	    //$asProfesional = $this->getObject()->getData();
	   // echo "<pre>"; print_r($asProfesional);exit;
		$this->widgetSchema['subject']=new sfWidgetFormInput(array(),array('style' => 'width:590px;'));
		$this->setDefault("subject",$this->getOption("subject"));
		
		$this->widgetSchema['body'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_body', 'max_length' => 12300));
		
		$this->widgetSchema->setFormFormatterName('list');
		$this->widgetSchema->setNameFormat('contact[%s]');
		$this->widgetSchema['user_id']=new sfWidgetFormInputHidden();
		$this->setDefault("user_id",$this->getOption("profesional")->getUserId());

		$this->widgetSchema['profesional_id']=new sfWidgetFormInputHidden();
		$this->setDefault("profesional_id",$this->getOption("profesional")->getId());

		$this->validatorSchema["subject"]=new sfValidatorString(array("required"=>"true"));
		$this->validatorSchema["profesional_id"]=new sfValidatorString(array("required"=>"true"));
		$this->validatorSchema["user_id"]=new sfValidatorString(array("required"=>"true"));
		$this->validatorSchema['body'] = new sfValidatorString(array('max_length' => 12300),array('max_length' => 'Has superado el espacio permitido.'));
		$this->validatorSchema["body"]->setMessage("required", 'Necesitas incluir un comentario.');
                $this->validatorSchema["subject"]->setMessage("required", 'Necesitas incluir un título.');
		
		$this->widgetSchema->setLabels(array(
				'subject' 	=> 	'Asunto',
				'body'		=> 	'Sugerencia',
		));		
		parent::setup();
	}
}
