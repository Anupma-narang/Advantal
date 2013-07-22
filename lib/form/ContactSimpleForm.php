<?php

class ContactSimpleForm extends sfFormSymfony {

    public function setup() {
        $this->widgetSchema['subject'] = new sfWidgetFormInput(array(), array('size' => 70));
        $this->setDefault("subject", $this->getOption("subject"));
        //$this->widgetSchema['body']=new sfWidgetFormTextarea();
        //$this->widgetSchema['body'] = new sfWidgetFormTextarea(array(),array('rows' =>20, 'cols' => 60));

        $this->widgetSchema['body'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_body', 'max_length' => 3000));

        $this->widgetSchema->setFormFormatterName('list');
        $this->widgetSchema->setNameFormat('contact[%s]');
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        $this->setDefault("user_id", $this->getOption("concurso")->getUserId());

        $this->widgetSchema['concurso_id'] = new sfWidgetFormInputHidden();
        $this->setDefault("concurso_id", $this->getOption("concurso")->getId());

        $this->validatorSchema["subject"] = new sfValidatorString(array("required" => "true"));
        $this->validatorSchema["concurso_id"] = new sfValidatorString(array("required" => "true"));
        $this->validatorSchema["user_id"] = new sfValidatorString(array("required" => "true"));
        //$this->validatorSchema["body"]=new sfValidatorString(array("required"=>"true"));
        //$this->validatorSchema['body'] = new sfValidatorString(array('max_length' => 12300),array('max_length' => 'Has superado el espacio permitido.'));
        $this->validatorSchema['body'] = new sfValidatorString(array('required' => true), array('required' => 'No has incluido una sugerencia.'));
        $this->validatorSchema["body"]->setMessage("required", 'No has incluido una sugerencia.');

        $this->widgetSchema->setLabels(array(
            'subject' => 'Asunto',
            'body' => 'Sugerencia',
        ));

        parent::setup();
    }

    public function configure() {
        $this->widgetSchema['body'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_body', 'max_length' => 3000));
        $this->validatorSchema["body"] = new sfValidatorString(array('required' => true), array('required' => 'No has incluido una sugerencia.'));
        $this->widgetSchema->setLabels(array(
            'subject' => 'Asunto',
            'body' => 'Sugerencia',
        ));
    }

}

class ContactContribucionSimpleForm extends sfFormSymfony {

    public function setup() {
        $this->widgetSchema['subject'] = new sfWidgetFormInput(array(), array('size' => 70));

        $this->setDefault("subject", $this->getOption("subject"));

        //$this->widgetSchema['body'] = new sfWidgetFormTextarea(array(),array('rows' =>20, 'cols' => 60));
        $this->widgetSchema['body'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_body', 'max_length' => 12300));

        $this->widgetSchema->setFormFormatterName('list');
        $this->widgetSchema->setNameFormat('contact[%s]');
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        $this->setDefault("user_id", $this->getOption("contribucion")->getUserId());

        $this->widgetSchema['contribucion_id'] = new sfWidgetFormInputHidden();
        $this->setDefault("contribucion_id", $this->getOption("contribucion")->getId());

        $this->validatorSchema["subject"] = new sfValidatorString(array("required" => "true"));
        $this->validatorSchema["contribucion_id"] = new sfValidatorString(array("required" => "true"));
        $this->validatorSchema["user_id"] = new sfValidatorString(array("required" => "true"));
        //$this->validatorSchema["body"]=new sfValidatorString(array("required"=>"true"));
        $this->validatorSchema['body'] = new sfValidatorString(array('max_length' => 12300), array('max_length' => 'Has superado el espacio permitido.'));
        $this->validatorSchema["body"]->setMessage("required", 'No has incluido una sugerencia.');


        $this->widgetSchema->setLabels(array(
            'subject' => 'Asunto',
            'body' => 'Sugerencia',
        ));

        parent::setup();
    }

    public function configure() {
        $this->widgetSchema['body'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_body', 'max_length' => 3000));
        $this->validatorSchema["body"] = new sfValidatorString(array('required' => true), array('required' => 'No has incluido una sugerencia.'));
        $this->widgetSchema->setLabels(array(
            'subject' => 'Asunto',
            'body' => 'Sugerencia',
        ));
    }

}
