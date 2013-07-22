<?php

class sfApplyPerfilForm extends sfGuardUserProfileForm {

    public function configure() {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
        parent::configure();

        $sexs = array(null => __('Selecciona tu sexo'), 'hombre' => __('Hombre'), 'mujer' => __('Mujer'));

        $default_image = $this->getObject()->getImage();
        $default_image = sprintf('/%s/users/%s', sfConfig::get('sf_upload_dir_name'), !empty($default_image) ? $default_image : 'default.png');
        $range = range(date('Y', strtotime('12 years ago')), '1900');

        $this->widgetSchema->setNameFormat('sfApplyPerfil[%s]');
        $this->widgetSchema['sex'] = new sfWidgetFormChoice(array('choices' => $sexs));
        $this->widgetSchema['fecha_nac'] = new sfWidgetFormDate(array('format' => '%day% %month% %year%', 'years' => array_combine($range, $range)));
        $this->widgetSchema['formacion_academica_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'FormacionAcademica', 'add_empty' => __('Selecciona tu formación')));
        $this->widgetSchema['colaborador_nivel_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ColaboradorNivelUno', 'add_empty' => __('Selecciona tu sector profesional')));
        $this->widgetSchema['colaborador_nivel_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'ColaboradorNivelDos', 'depends' => 'ColaboradorNivelUno', 'add_empty' => __('Selecciona tu actividad profesional')));
        $this->widgetSchema['road_type_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'RoadType', 'order_by' => array('orden', 'asc'), 'add_empty' => __('Selecciona tu vía')), array('class' => 'select_pequeño'));
        $this->widgetSchema['direccion'] = new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_32_c'));
        $this->widgetSchema['numero'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));
        $this->widgetSchema['piso'] = new sfWidgetFormInputText(array(), array('maxlength' => 3, 'class' => 'tamano_2_c'));
        $this->widgetSchema['puerta'] = new sfWidgetFormInputText(array(), array('maxlength' => 6, 'class' => 'tamano_4_c'));
        $this->widgetSchema['cp'] = new sfWidgetFormInput(array(), array('maxlength' => 5, 'class' => 'tamano_6_c'));
        $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'States', 'table_method' => 'getWithoutTodas', 'add_empty' => __('Selecciona tu provincia'), 'order_by' => array('orden', 'asc')));
        $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => 'City', 'depends' => 'States', 'ajax' => true, 'add_empty' => __('Selecciona tu localidad')), array());
        $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array('file_src' => $default_image, 'is_image' => true, 'edit_mode' => true, 'with_delete' => false,
                    'template' => '<table class="uploadfield" cellpadding="0" cellmargin="0" style="margin-top: 0"><tr><td valign="top">%input%</td><td><div class="perfilIMG">%file%</div></td></tr></table>'));
//            'template'  => '<table><tr><td style="vertical-align: bottom;">%file%</td><td style="vertical-align: top;">%input%<br/>%delete% %delete_label%</td><td width="100%"></td></tr></table>'));
        $this->widgetSchema['metodo_cobro_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'MetodoCobro', 'default' => 1));
        $this->widgetSchema->setLabels(array(
            'sex' => __('Soy*'),
            'fecha_nac' => __('Mi fecha de nacimiento'),
            'formacion_academica_id' => __('Mi formación académica'),
            'colaborador_nivel_uno_id' => __('Mi sector profesional*'),
            'colaborador_nivel_dos_id' => __('Mi actividad profesional*'),
            'road_type_id' => __('Mi tipo de vía'),
            'direccion' => __('Mi dirección'),
            'numero' => __('Nº'),
            'piso' => __('Piso'),
            'puerta' => __('Puerta'),
            'cp' => __('Mi C.P.'),
            'states_id' => __('Mi provincia*'),
            'city_id' => __('Mi localidad*'),
            'image' => __('Mi imagen'),
            'metodo_cobro_id' => __('Mi método de cobro de recompensas')
        ));

        $this->validatorSchema['sex'] = new sfValidatorChoice(array('choices' => array_keys($sexs), 'required' => true), array('required' => __('Necesitas seleccionar tu sexo.')));
        $this->validatorSchema['fecha_nac'] = new sfValidatorDate(array('required' => false, 'min' => '01-01-1900', 'max' => date('d-m-Y', strtotime('18 years ago'))), array('invalid' => __('Esa fecha de nacimiento no es válida.'), 'max' => __('Para crear una cuenta necesitas ser mayor de edad.')));
        $this->validatorSchema['road_type_id'] = new sfValidatorDoctrineChoice(array('model' => 'RoadType', 'required' => false));
        $this->validatorSchema['colaborador_nivel_uno_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ColaboradorNivelUno'), 'required' => true), array('required' => __('Necesitas seleccionar tu sector profesional.')));
        $this->validatorSchema['colaborador_nivel_dos_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ColaboradorNivelDos'), 'required' => true), array('required' => __('Necesitas seleccionar tu actividad profesional.')));
        $this->validatorSchema['direccion'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 70, 'required' => false), array('invalid' => __('Esa dirección no es válida.'))),
                    new sfValidatorNombres(array('caracteres_no_validos' => sfApplyForm2::$caracteres_no_validos_direccion, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ),
                        array('required' => false),
                        array('invalid' => __('Esa dirección no es válida.'))
        );

        $caracteres_no_validos_numero = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_numero[array_search('/', $caracteres_no_validos_numero)]); // para número sí permitimos la barra
        $this->validatorSchema['numero'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 6, 'required' => false)),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_numero, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ),
                        array('required' => false),
                        array('invalid' => __('Ese Nº no es válido.'))
        );

        $caracteres_no_validos_piso_puerta = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_piso_puerta[array_search('.', $caracteres_no_validos_piso_puerta)]); // para piso y puerta sí permitimos el punto
        $this->validatorSchema['piso'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 6, 'required' => false)),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ),
                        array('required' => false),
                        array('invalid' => __('Ese Piso no es válido.'))
        );

        $caracteres_no_validos_piso_puerta = sfApplyForm2::$caracteres_no_validos_direccion;
        unset($caracteres_no_validos_piso_puerta[array_search('.', $caracteres_no_validos_piso_puerta)]); // para piso y puerta sí permitimos el punto
        $this->validatorSchema['puerta'] = new sfValidatorAnd(array(
                    new sfValidatorString(array('max_length' => 6, 'required' => false)),
                    new sfValidatorNombres(array('caracteres_no_validos' => $caracteres_no_validos_piso_puerta, 'inicio' => "/^[a-z0-9\áéíóúAÉÍÓÚÑñ]*$/", 'repeticiones_no_validas' => array('a', 'b', 'c', 'd', 'e', 'f', 'h', 'g', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z')))
                        ),
                        array('required' => false),
                        array('invalid' => __('Esa Puerta no es válida.'))
        );
        $this->validatorSchema['cp'] = new sfValidatorPass();
        $this->validatorSchema['states_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('States')), array('required' => __('Necesitas seleccionar tu provincia.')));
        $this->validatorSchema['city_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'required' => true), array('required' => __('Necesitas seleccionar tu localidad.')));
        $this->validatorSchema['image'] = new sfValidatorFile(array('required' => false, 'max_size' => 500000, 'mime_types' => array('image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/x-ms-bmp', 'image/x-png'),), array('mime_types' => 'Ese formato de imagen no es válido.', 'max_size' => 'El tamaño de la imagen supera los 500 KB'));
//        $this->validatorSchema['image_delete'] = new sfValidatorPass();
        $this->validatorSchema['metodo_cobro_id'] = new sfValidatorDoctrineChoice(array('model' => 'MetodoCobro'));

        $this->validatorSchema->setPreValidator(new sfValidatorCallback(array('callback' => array($this, 'preValidate'))));
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback' => array($this, 'postValidate'))));

        $this->useFields(array('image', 'sex', 'fecha_nac', 'formacion_academica_id', 'colaborador_nivel_uno_id',
            'colaborador_nivel_dos_id', 'cp', 'road_type_id', 'direccion', 'numero', 'piso',
            'puerta', 'states_id', 'city_id', 'metodo_cobro_id'));

        if (!$notification = Doctrine::getTable('usernotification')->createQuery()->where('user_id=?', $this->getObject()->getUserId())->fetchOne())
            $notification = new UserNotification();
        $this->embedForm('notification', new UserNotificationForm($notification));
    }

    public function preValidate($validator, $values) {
        if (($values['states_id'] == 16) || ($values['states_id'] == 35)) {
            $this->getValidator('city_id')->setOption('required', false);
        }

        if (in_array($values['colaborador_nivel_uno_id'], array(22, 23, 24, 25))) {
            // Ama de casa, Desemplado, Estudiante y Otra respectivamente
            $this->getValidator('colaborador_nivel_dos_id')->setOption('required', false);
        }
    }

    public function postValidate($validator, $values) {
        if ((!empty($values['states_id'])) and (!empty($values['cp']))) {
            $name = Doctrine::getTable('States')->findOneById($values['states_id'])->getName();
            if (false == cp::checkCpByStateName($values['cp'], $name)) {
                $invalid = new sfValidatorError($validator, 'Ese C.P. no es válido.');
                throw new sfValidatorErrorSchema($validator, array('cp' => $invalid));
            }
        }

        return $values;
    }

    public function doSave($con = null) {
        $imageObj = $this->getValue('image');
        if (is_object($imageObj) and 'sfValidatedFile' == get_class($imageObj)) {
            $oldImage = $this->getObject()->getImage();
            if ($this->getObject()->setImage($imageObj)) {
                if (!empty($oldImage) and 'default.png' != $oldImage) {
                    @unlink(sfConfig::get('sf_users_dir') . '/' . $oldImage);
                }
            }
        }

        parent::doSave($con);

        if ($this->getObject()->getMetodoCobroId() == 1) {
            //hay que borrar todos los metodos de este user
            Doctrine::getTable('MetodoPaypal')->createQuery()->delete()->where('user_id=?', $this->getObject()->getUserId())->execute();
            Doctrine::getTable('MetodoBanco')->createQuery()->delete()->where('user_id=?', $this->getObject()->getUserId())->execute();
        }
    }

    public function doUpdateObject($values) {
        if (is_object($values['image']) and 'sfValidatedFile' == get_class($values['image'])) {
            $image = $values['image'];
            if ($image->isSaved()) {
                $values['image'] = basename($image->getSavedName());
            }
        }
        parent::doUpdateObject($values);
    }

    public function saveEmbeddedForms($con = null, $forms = null) {
        $notification = Doctrine::getTable('usernotification')
                ->createQuery()
                ->where('user_id=?', $this->getObject()->getUserId())
                ->fetchOne();
        $is_new = false;
        if (!is_object($notification)) {
            $notification = new UserNotification();
            $is_new = true;
        }
        $notification->user_id = $this->getObject()->getUserId();
        $values = $this->getValues();
        $notification->fromArray($values['notification']);

        if ($is_new) {
            $notification->hash = sha1(microtime(true) . mt_rand(10000, 90000));
        }

        $notification->save();
    }

}