<?php

class ConcursoEmpresaSearchForm extends BaseForm {
    public function configure()
    {
  	parent::configure();
  	sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

  	$n_participantes_choices = array(0=>__('Selecciona rango'),1=>'1-50',2=>'51-100',3=>'101-250',4=>'251-500',5=>'501-1000',6=>'1000+');
        $filter_choices = array(
            1 => __('Fecha de publicación'),
            2 => __('Empresa/Entidad'),
            3 => __('Categoría del concurso'),
            4 => __('Actividad'),
            5 => __('Provincia'),
            6 => __('Localidad'));


        $this->disableLocalCSRFProtection();
        $this->widgetSchema->setNameFormat(__CLASS__.'[%s]');

  	$this->widgetSchema['empresa'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_14_c'));
  	$this->validatorSchema['empresa'] = new sfValidatorString(array('required' => false));

  	$this->widgetSchema['states_id'] = new sfWidgetFormDoctrineChoice(array('model'=>'States','table_method' => 'getWithTodas','add_empty' => 'Selecciona provincia'));
  	$this->validatorSchema['states_id'] = new sfValidatorDoctrineChoice(array('model'=>'States', 'required'=>false));

  	$this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array('model'=>'City','depends'=>'States','add_empty'=>'Selecciona localidad','ajax' => true));
  	$this->validatorSchema['city_id']  = new sfValidatorDoctrineChoice(array('model' => 'City', 'required' => false));

  	$this->widgetSchema['concurso_categoria_id'] = new sfWidgetFormDoctrineChoice(array('model'=>'ConcursoCategoria','add_empty'=>__('Selecciona categoría'),'table_method'=>'selectTipoCategoria'));
  	$this->validatorSchema['concurso_categoria_id'] = new sfValidatorDoctrineChoice(array('model'=>'ConcursoCategoria','required'=>false));

  	$this->widgetSchema['estado_id'] = new sfWidgetFormDoctrineChoice(array(
            'query'=>Doctrine::getTable('ConcursoEstado')->createQuery()->where('value != 9')->andWhere('value != 8')->andWhere('value != 1'),
            'model'=>'ConcursoEstado','add_empty'=>__('Selecciona estado')));
  	$this->validatorSchema['estado_id'] = new sfValidatorDoctrineChoice(array(
            'query'=>Doctrine::getTable('ConcursoEstado')->createQuery()->where('value != 9')->andWhere('value != 8')->andWhere('value != 1'),
            'model'=>'ConcursoEstado','required'=>false));

  	$this->widgetSchema['autor'] = new sfWidgetFormInputText(array(), array('maxlength' =>70, 'class' => 'tamano_32_c'));
  	$this->validatorSchema['autor'] = new sfValidatorString(array('required' => false));

  	$this->widgetSchema['n_participantes'] = new sfWidgetFormChoice(array('choices' => $n_participantes_choices));
  	$this->validatorSchema['n_participantes'] = new sfValidatorChoice(array('choices' => array_keys($n_participantes_choices), 'required'=>false));

        $this->widgetSchema['filter_option'] = new sfWidgetFormChoice(array('choices' => $filter_choices));
        $this->validatorSchema['filter_option'] = new sfValidatorChoice(array('choices' => array_keys($filter_choices), 'required'=>false));
        $this->setDefault('filter_option', 1);

  	$this->widgetSchema['filter_states_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'States', 'table_method' => 'getWithTodas', 'add_empty' => 'Selecciona provincia'));
        $this->validatorSchema['filter_states_id'] = new sfValidatorPass();

  	$this->widgetSchema['filter_city_id'] = new sfWidgetFormChoice(array('choices'=>array(-1=>'Selecciona localidad')));
        $this->validatorSchema['filter_city_id']  = new sfValidatorPass();

  	$this->widgetSchema->setLabels(array(
            'empresa'                => __('Empresa/Entidad'),
            'states_id'              => __('Provincia'),
            'city_id'                => __('Localidad'),
            'concurso_categoria_id'  => __('Categoría del concurso'),
            'n_participantes'        => __('Nº de participantes'),
            'autor'                  => __('Creado por')
  	));

        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'postValidate'))));
    }

    public function postValidate($validator, $values) {
        $values['filter_states_id'] = $values['states_id'];
        $values['filter_city_id'] = $values['city_id'];
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
