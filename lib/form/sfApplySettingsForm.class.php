<?php
class sfApplySettingsForm extends sfGuardUserProfileForm
{
	public function configure()
	{
		parent::configure();
		sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));		//para las traduciones del formulario

		// We're editing the user who is logged in. It is not appropriate
		// for the user to get to pick somebody else's userid, or change
		// the validate field which is part of how their account is
		// verified by email. Also, users cannot change their email
		// addresses as they are our only verified connection to the user.

		unset(
				$this['user_id'],
				$this['change_points'],
				$this['money'],
				$this['validate'],
				$this['email'],
				$this['email2'],  
				$this['password'], 
				$this['password2'],
				$this['rank']
		);
		
		$this->widgetSchema['colaborador_nivel_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
				'model'     => 'ColaboradorNivelUno',
				'add_empty' => __('Selecciona tu sector profesional')));
		
		$this->validatorSchema['colaborador_nivel_uno_id'] = new sfValidatorDoctrineChoice(array(
				'model' => $this->getRelatedModelName('ColaboradorNivelUno'), 
				'required' => true));
		
		$this->widgetSchema['colaborador_nivel_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
				'model'     => 'ColaboradorNivelDos',
				'depends'   => 'ColaboradorNivelUno',
				'add_empty' => __('Selecciona actividad profesional')));
		$this->validatorSchema['colaborador_nivel_dos_id'] = new sfValidatorDoctrineChoice(array(
				'model' => $this->getRelatedModelName('ColaboradorNivelDos'), 
				'required' => true));
		
		$this->widgetSchema['tipo_documento_id'] = new sfWidgetFormDoctrineDependentSelect(array(
				'model'     => 'TipoDocumento',
				'add_empty' => 'Selecciona Tipo '));
		
		$this->widgetSchema['states_id'] = new sfWidgetFormDoctrineChoice(array(
				'model'   => 'States',
                'order_by' => array('orden', 'asc'),
				'add_empty' => __('Seleccione Provincia')),
				array('class' => 'select_pequeño'));
		$this->widgetSchema['road_type_id'] = new sfWidgetFormDoctrineChoice(array(
				'model'   => 'RoadType',
				'order_by'=>array('orden'), 
				'add_empty' => __('Selecciona tu vía')),
				array('class' => 'select_pequeño'));
		$this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
				'model'     => 'City',
				'depends'   => 'States',
				'ajax'=>	true,
				'add_empty' => __('Selecciona Localidad'),
		), array('class' => 'select_pequeño'));
		$this->widgetSchema['formacion_academica_id'] = new sfWidgetFormDoctrineChoice(array(
				'model'   => 'FormacionAcademica',
				'add_empty' => __('Selecciona tu formación')));
		
		$this->widgetSchema['metodo_cobro_id'] = new sfWidgetFormDoctrineChoice(array(
				'model'   => 'metodo_cobro',
				'add_empty' => __('Selecciona tu método de cobro')));
		
		//Inicio de carga de Imagenes
		$this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
				'file_src' => '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/'
				. basename(sfConfig::get('sf_users_dir')) . '/' .
				$this->getObject()->getImage(),
				'is_image' => true,
				'edit_mode' => strlen($this->getObject()->getImage()) > 0,
				'template' => '
				<div id=remove>
				%file%
				%input%<br/>
				%delete% %delete_label%
				</div>'));
		
		$this->validatorSchema['image'] = new sfValidatorFile(array(
				'required' => false,
				'mime_types' => 'web_images'));
		
		$this->validatorSchema['image_delete'] = new sfValidatorPass();
		
		$this->setWidget('name', new sfWidgetFormInput(
				array(), array('maxlength' => 32, 'size' => 32)
		));
		$this->setWidget('username', new sfWidgetFormInput(
				array(), array('maxlength' => 32, 'size' => 32)
		));
		$this->setWidget('surname1', new sfWidgetFormInput(
				array(), array('maxlength' => 32, 'size' => 32)
		));
		$this->setWidget('surname2', new sfWidgetFormInput(
				array(), array('maxlength' => 32, 'size' => 32)
		));
		
		
		$this->setWidget('password', new sfWidgetFormInputPassword(
				array(), array('maxlength' => 16, 'size' => 16)
		));
		
		
		$this->widgetSchema['fecha_nac'] = new sfWidgetFormJQueryDate(array(
				'config'  => "{}",
				'culture' => sfContext::getInstance()->getUser()->getCulture(),
				'date_widget' => new sfWidgetFormDate(array('format' => '%day% %month% %year%'))
		));	

		$this->validatorSchema['name'] = new sfValidatorString(array('max_length' => 80, 'required' => true));
		$sexs = array(null => __('Selecciona tu sexo'), 'hombre' => __('Hombre'), 'mujer' => __('Mujer'));
		$this->widgetSchema['sex'] = new sfWidgetFormChoice(array('choices' => $sexs));
		$this->validatorSchema['sex'] = new sfValidatorChoice(array('choices' =>  array_keys($sexs), 'required' => true));
		
		$this->widgetSchema['numero'] = new sfWidgetFormInputText(array(), array('size' => 4));
		$this->widgetSchema['piso'] = new sfWidgetFormInputText(array(), array('size' => 4));
		$this->widgetSchema['puerta'] = new sfWidgetFormInputText(array(), array('size' => 4));		
		
		
		$this->widgetSchema->setLabels(array(
				'email'			=> 	__('Tu correo electrónico*'),
				'email2' 		=> 	__('Repite tu correo electrónico*'),
				'username' 		=> 	__('Tu Usuario/Alias*'),
				'password'		=>	__('Tu contraseña*'),
				'password2' 	=> 	__('Repite tu contraseña*'),
				'nifnie' 		=> 	__('NIF/NIE'),
				'name' 			=> 	__('Tu nombre*'),
				'image' 		=> 	__('Tu imagen'),
				'fecha_nac' 	=> 	__('Tu fecha de nacimiento'),
				'sex'			=>	__('Eres*'),
				'surname1'		=>  __('Tu apellido 1*'),
				'surname2'		=>  __('Tu apellido 2*'),
				'colaborador_nivel_uno_id'	=> __('Tu sector profesional*'),
				'colaborador_nivel_dos_id'	=> __('Tu actividad profesional*'),
				'road_type_id'	=>	__('Tu tipo de vía'),
				'direccion'		=>	__('Tu dirección'),
				'numero'		=>	__('Nº'),
				'piso'			=>	__('Piso'),
				'puerta'		=> 	__('Puerta'),
				'cp'			=>	__('Tu CP'),
				'states_id'		=>	__('Tu provincia*'),
				'city_id'		=>	__('Tu localidad*'),
				'formacion_academica_id'	=> __('Tu formación académica'),
				'metodo_cobro_id'			=> __('Tu método de cobro de recompensas')
		));
		
		$this->widgetSchema->setNameFormat('sfApplySettings[%s]');
		$this->widgetSchema->setFormFormatterName('list');
	}
	
	public function doSave($con = null)
	{
		//Inicio carga de imagenes
		$upload = $this->getValue('image');
		$delete = $this->getValue('image_delete');
	
		if ($upload) {
	
			$filename = sha1($upload->getOriginalName() . microtime() . rand()) . $upload->getExtension($upload->getOriginalExtension());
	
			$thumbnailImagen = new sfThumbnail(50, 50, true, false, 75, 'sfGDAdapter');
			//$thumbnailImagen = new sfThumbnail(62, 62, true, false, 75, 'sfImageMagickAdapter');
	
			$filepath = sfConfig::get('sf_users_dir') . '/' . $filename;
	
			$upload->save(sfConfig::get('sf_users_dir') . '/' . $filename);
			$thumbnailImagen->loadFile($filepath);
			$thumbnailImagen->save($filepath);
	
		} else if ($delete) {
	
			$filename = $this->getObject()->getImage();
			$filepath = sfConfig::get('sf_users_dir') . '/' . $filename;
			@unlink($filepath);
			//            $thumbnailpath = sfConfig::get('sf_thumbnail_dir') . '/' . $filename;
			//            @unlink($thumbnailpath);
			$this->getObject()->setImage(null);
		}
	
		return parent::doSave($con);
	}	
}

