<?php

class ConcursoProductoSearchForm extends BaseForm {
    public function configure()
    {
  	parent::configure();
  	sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        $this->disableLocalCSRFProtection();
        $this->widgetSchema->setNameFormat(__CLASS__.'[%s]');

  	$this->widgetSchema['producto'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_27_c', 'maxlength' => 70));
  	$this->validatorSchema['producto'] = new sfValidatorString(array('required' => false));

  	$this->widgetSchema['marca'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_20_c', 'maxlength' => 70));
  	$this->validatorSchema['marca'] = new sfValidatorString(array('required' => false));

  	$this->widgetSchema['modelo'] = new sfWidgetFormInputText(array(), array('class' => 'tamano_20_c','maxlength' => 20));
  	$this->validatorSchema['modelo'] = new sfValidatorString(array('required' => false));

  	$this->widgetSchema['estado_id'] = new sfWidgetFormDoctrineChoice(array(
            'query' => Doctrine::getTable('ConcursoEstado')->createQuery()->where('value!=9')->andWhere('value!=8')->andWhere('value!=1'),
            'model' => "ConcursoEstado","add_empty" => __('Selecciona estado')),array('class' => 'tamano_32_c'));
  	$this->validatorSchema['estado_id'] = new sfValidatorDoctrineChoice(array('model' => 'ConcursoEstado','required' => false));

  	$this->widgetSchema['autor'] = new sfWidgetFormInputText(array(), array('maxlength' =>70, 'class' => 'tamano_32_c'));
  	$this->validatorSchema['autor'] = new sfValidatorString(array('required' => false));

        $n_participantes_choices = array(0=>__('Selecciona rango'),1=>'1-50',2=>'51-100',3=>'101-250',4=>'251-500',5=>'501-1000',6=>'1000+');
  	$this->widgetSchema['n_participantes'] = new sfWidgetFormChoice(array('choices' => $n_participantes_choices));
  	$this->validatorSchema['n_participantes'] = new sfValidatorChoice(array('choices' => array_keys($n_participantes_choices), 'required'=>false));

        $filter_choices = array(11 => __('Fecha de publicación'), 12 => __('Nombre de producto'), 13 => __('Categoría de concurso'),
            14 => __('Tipo de producto'), 15 => __('Marca'), 16 => __('Modelo'));
        $this->widgetSchema['filter_option'] = new sfWidgetFormChoice(array('choices' => $filter_choices));
        $this->validatorSchema['filter_option'] = new sfValidatorChoice(array('choices' => array_keys($filter_choices), 'required'=>false));
        $this->setDefault('filter_option', 11);

        $this->widgetSchema['filter_marca'] = new sfWidgetFormInputText(array(),array('maxlength' => 70, 'class' => 'tamano_20_c'));
        $this->validatorSchema['filter_marca'] = new sfValidatorPass();

        $this->widgetSchema['filter_modelo'] = new sfWidgetFormInputText(array(), array('maxlength' => 20, 'class' => 'tamano_20_c'));
        $this->validatorSchema['filter_modelo'] = new sfValidatorPass();

				$this->widgetSchema['concurso_categoria_id'] = new sfWidgetFormDoctrineChoice(array(
            'query' => Doctrine::getTable('ConcursoCategoria')->createQuery()->where('concurso_tipo_id=2')->orderBy('name', 'desc'),
            'model' => "ConcursoCategoria","add_empty" => __('Selecciona categoría')),array('class' => 'tamano_32_c'));
				$this->validatorSchema['concurso_categoria_id'] = new sfValidatorDoctrineChoice(array('model' => 'ConcursoCategoria','required' => false));

        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'postValidate'))));

        $this->widgetSchema->setLabels(array(
            'n_participantes'       => __('Nº de participantes'),
            'autor'                 => __('Creado por'),
            'concurso_categoria_id' => __('Categoría del concurso'),
        ));
    }

    public function postValidate($validator, $values) {
        $values['filter_marca'] = $values['marca'];
        $values['filter_modelo'] = $values['modelo'];
        return $values;
    }

    public function processForm($request)
    {
        $extra = $request->getParameter('extra','');
        $form_name = $this->getName();
        $user = sfContext::getInstance()->getUser();
        $userData = array();
        
        if ($user->getAttribute('visit_count') == null or $extra == 'restore')
        {
            if ($user->isAuthenticated())
            {
                $userData = sfGuardUserDataTable::getbyName($form_name);
            }
            else
            {
                $userData = $request->getCookie($form_name, null);
                $userData = is_null($userData) ? null : unserialize(base64_decode($userData));
            }
//            if($request->hasParameter('estado'))
//            {
//                $userData['estado_id'] = intval($request->getParameter('estado', 0));
//            }
        }
        if ($request->isMethod('POST') and $extra != 'restore')
        {
            $userData = $request->getParameter($form_name);
        }
        if (empty($userData))
        {
            $userData = $this->getDefaults();
        }

        $this->bind($userData);
        if ($extra == 'save' and $this->isValid())
        {
            sfGuardUserDataTable::setbyName($form_name, $this->getValues());
        }
    }
}
