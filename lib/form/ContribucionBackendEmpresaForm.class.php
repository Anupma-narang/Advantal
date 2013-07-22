<?php

sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N', 'Url'));

class ContribucionBackendEmpresaForm extends ContribucionFormUno {

    public function configure() {

        unset($this["created_at"], $this["updated_at"], $this['fecha_destacado']);

        if ($this->isNew()) {
            unset($this['principal']);
        } else {
            $this->widgetSchema['numero'] = new sfWidgetFormInputHidden();
        }
        //para las traduciones del formulario
        //$this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => 'Selecciona Usuario'));
        //user_id
        $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User')));

        //username
        $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array("default" => (!$this->isNew() ? $this->getObject()->getUser()->getUsername() : "")), array('id' => 'contribucion_user', 'maxlength' => 25, 'style' => 'width:176px;'));
        $this->validatorSchema['user_name'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'column' => 'username'), array('required' => 'Necesitas seleccionar un Usuario.', 'invalid' => 'Ese Usuario no es válido.'));


        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_60_c'));
        $this->validatorSchema['name'] = new sfValidatorString(array('max_length' => 100), array('required' => 'No has incluido un título de la incidencia.'));

        $this->widgetSchema['plan_accion'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_plan_accion', 'max_length' => 43000));

        $this->widgetSchema['incidencia'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 12300));
        $this->validatorSchema["incidencia"]->setMessage("required", 'No has incluido una descripción de la incidencia.');

        $this->widgetSchema['resumen'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_resumen', 'max_length' => 1000));

        $this->widgetSchema->setDefault('destacado', true);

        $q = Doctrine_Query::create()->from('Concurso')->where('concurso_tipo_id = 1')->addWhere('concurso_estado_id = 2');
        $this->widgetSchema['concurso_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Concurso'), 'add_empty' => false, 'query' => $q, 'order_by' => array('id', 'desc')));


        /* $files = array();
          $j = 1;
          foreach ($this->getObject()->getContribucionArchivo() as $achivo) {
          $files[$j] = $achivo;
          $j++;
          }

          for ($i = 1; $i <= 5; $i++) {
          $this->embedForm('archivo_' . $i, new ContribucionArchivoForm((isset($files[$i])) ? $files[$i] : new ContribucionArchivo()));
          } */


        $files = array();
        $i = 1;
        foreach ($this->getObject()->getContribucionArchivo() as $file) {
            $files[$i] = $file->getFile();
            $i++;
        }
        for ($i = 1; $i <= 5; $i++) {
            $this->widgetSchema['archivo_' . $i] = new sfWidgetFormInputFileEditable(array(
                        'file_src' => (isset($files[$i]) ? $files[$i] : ''),
                        'is_image' => false,
                        'edit_mode' => isset($files[$i]) && strlen($files[$i]) > 0,
                        'template' => (isset($files[$i]) ? '<div id=remove><strong>%file%</strong><br/>%input%</div>' : '')
                    ));
        }
        for ($i = 1; $i <= 5; $i++) {
            $this->validatorSchema['archivo_' . $i] = new sfValidatorFile(array(
                        'required' => false,
                        'path' => 'images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_documents_dir')) . '/',
                        'mime_type_guessers' => array(array('fakemime', 'detect'))
                    ));
        }

        $this->validatorSchema['plan_accion'] = new sfValidatorString(
                        array('required' => true), array('required' => 'No has incluido tu Plan de acción.'));
        $this->validatorSchema["resumen"] = new sfValidatorString(
                        array('required' => true), array('required' => 'No has incluido el resumen de tu Plan de acción.'));

        $this->getWidgetSchema()->moveField('user_id', sfWidgetFormSchema::AFTER, 'name');

        $this->widgetSchema->setLabels(array(
            'name' => __('Título de la incidencia'),
            'user_name' => 'Usuario',
            'incidencia' => __('Descripción de la incidencia'),
            'plan_accion' => __('Plan de acción'),
            'resumen' => __('Resumen del Plan de acción'),
            'concurso_id' => __('Concurso asociado'),
            'contribucion_estado' => __('Estado contribución'),
            'principal' => __('Inicial'),
            'user_id' => __('Creado por'),
            'slug' => __('URL-alias'),
                //'concurso_tipo_id' =>	__('Tipo')
        ));
        $this->validatorSchema->setOption('allow_extra_fields', true);
    }

    public function save($con = null) {
        /* $isNew = $this->getObject()->isNew();

          $this->getObject()->setUserId($values['user_id']);
          $this->getObject()->save();
          echo ">>" . $this->getObject()->getId(); */

        if ($this->getObject()->isNew()) {
            $values = $this->getValues();
            $contribucion = new Contribucion();
            $contribucion->name = $values['name'];
            $contribucion->concurso_id = $values['concurso_id'];
            $contribucion->contribucion_estado_id = $values['contribucion_estado_id'];
            $contribucion->incidencia = $values['incidencia'];
            $contribucion->plan_accion = $values['plan_accion'];
            $contribucion->resumen = $values['resumen'];
            $contribucion->numero = $values['numero'];
            $contribucion->user_id = $values['user_id'];
            $contribucion->destacado = $values['destacado'];
            $contribucion->principal = 0;
            $contribucion->save();
        } else {
            $values = $this->getValues();

            $contribucion = Doctrine::getTable('contribucion')->createQuery()->where('id = ?', $values['id'])->fetchOne();
            $contribucion->name = $values['name'];
            $contribucion->concurso_id = $values['concurso_id'];
            $contribucion->contribucion_estado_id = $values['contribucion_estado_id'];
            $contribucion->incidencia = $values['incidencia'];
            $contribucion->plan_accion = $values['plan_accion'];
            $contribucion->resumen = $values['resumen'];
            $contribucion->user_id = $values['user_id'];
            $contribucion->destacado = $values['destacado'];
            $contribucion->principal = 0;
            $contribucion->save();
        }

        // archivos
        for ($i = 1; $i <= 5; $i++) {
            $upload = $this->getValue('archivo_' . $i);
            if (!is_null($upload)) {
                $filename = sha1($upload->getOriginalName() . microtime() . rand()) . $upload->getExtension($upload->getOriginalExtension());
                $upload->save($filename);

                $concurso_archivo = new ContribucionArchivo();
                $concurso_archivo->setContribucionId($contribucion->get('id'));
                $concurso_archivo->setFile($filename);
                $concurso_archivo->save();
            }
        }

        return $contribucion;
    }

}