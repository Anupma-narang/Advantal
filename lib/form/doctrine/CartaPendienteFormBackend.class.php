<?php

sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

class CartaPendienteFormBackend extends BaseProfesionalLetterForm {

    public function configure() {
        unset(
                $this["created_at"], $this["updated_at"],
                //$this['profesional_id'],
                $this['fecha_activacion'], $this['fecha_referendum'], $this['fecha_destacado'], $this['fecha_revision'], $this['fecha_deliberacion'], $this['fecha_rechazado'], $this['fecha_cerrado'], $this['fecha_nulo'], $this['revision_last_state_id'], $this['fecha_observacion'], $this['profesional_activa_desa_id'],
                //$this['profesional_apro_despro_id'],
                $this['states_id'], $this['city_id'], $this['profesional_id']
        );

        $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('maxlength' => 70, 'class' => 'tamano_60_c'));
        $this->validatorSchema['name']->setMessage("required", 'No has incluido el título de tu carta.');

        //$this->widgetSchema['user_id']                      = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false));
        //$this->setValidators['user_id']                    = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User')));

        $this->widgetSchema['profesional_letter_estado_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalLetterEstado'), 'table_method' => 'getEstedioLetterName', 'add_empty' => true, 'label' => 'Estado'));
        $this->setValidators['profesional_letter_estado_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProfesionalLetterEstado'), 'column' => 'id'));

        //$this->widgetSchema["user_id"] = new sfWidgetFormInputHidden();
        //$this->setDefault("user_id", sfContext::getInstance()->getUser()->getGuardUser()->getId());

        $this->widgetSchema["profesional_apro_despro_id"] = new sfWidgetFormInputHidden(array(), array('value' => 1));


        $asProfessionalData = sfContext::getInstance()->getRequest()->getParameter('profesional_letter');
        $this->type = isset($asProfessionalData) ? $asProfessionalData['profesional_letter_type_id'] : $this->getObject()->getProfesionalLetterTypeId();

        $this->setDefault("profesional_letter_type_id", $this->type);

        if ($this->isNew())
            $this->setDefault("profesional_letter_estado_id", 1);

        $this->embedRelation('Profesional', 'ProfesionalAdminForm');

        /* $this->widgetSchema['incidencia'] = new sfWidgetFormTextareaCKEditor(array('width' => 600, 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 12300));
          $this->validatorSchema['incidencia'] = new sfValidatorString(array('max_length' => 20000),array('max_length' => 'Has superado el espacio permitido para la descripción de la incidencia.'));
          $this->validatorSchema["incidencia"]->setMessage("required", 'No has incluido una descripción de la incidencia.');
         */
        $this->widgetSchema['description'] = new sfWidgetFormTextareaCKEditor(array('width' => ((sfConfig::get("sf_app") == "backend") ? 600 : 490), 'height' => 200, 'err_id' => 'Error_max_length_incidencia', 'max_length' => 8300));
        $this->validatorSchema['description'] = new sfValidatorString(array('max_rep_length' => 8300), array('max_rep_length' => 'Has superado el espacio permitido para tu recomendación.'));
        $this->validatorSchema["description"]->setMessage("required", 'No has incluido tu recomendación.');


        $this->widgetSchema['plan_accion'] = new sfWidgetFormTextareaCKEditor(array('width' => ((sfConfig::get("sf_app") == "backend") ? 600 : 490), 'height' => 200, 'err_id' => 'Error_max_length_plan_accion', 'max_length' => 12300));
        $this->validatorSchema['plan_accion'] = new sfValidatorString(array('max_rep_length' => 12300, 'required' => ($this->type == 2) ? false : true), array('max_rep_length' => 'Has superado el espacio permitido para la Plan de acción.'));
        $this->validatorSchema["plan_accion"]->setMessage("required", 'No has incluido tu Plan de acción.');


        if ($this->type == 2) {
            unset(
                    $this["created_at"], $this["updated_at"], $this['archivo_1'], $this['archivo_2'], $this['archivo_3'], $this['archivo_4'], $this['archivo_5']
            );
        } else {
            if (!$this->getObject()->isNew()) {
                $archivos = Doctrine_Query::create()
                                ->select('a.*')
                                ->from('ProfesionalArchivo a')
                                ->where('profesional_id', $this->getObject()->getProfesional()->getId())->fetchArray();

                if (count($archivos) > 0) {
                    $archivo_1 = Doctrine::getTable('ProfesionalArchivo')->find($archivos[0]['id']);
                    $archivo_2 = Doctrine::getTable('ProfesionalArchivo')->find($archivos[1]['id']);
                    $archivo_3 = Doctrine::getTable('ProfesionalArchivo')->find($archivos[2]['id']);
                    $archivo_4 = Doctrine::getTable('ProfesionalArchivo')->find($archivos[3]['id']);
                    $archivo_5 = Doctrine::getTable('ProfesionalArchivo')->find($archivos[4]['id']);
                }
            }


            $archivo_1 = isset($archivo_1) ? $archivo_1 : new ProfesionalArchivo();
            $archivo_1->Profesional = $this->getObject()->getProfesional();
            $formulario_1 = new ProfesionalArchivoFormBackend($archivo_1);
            $this->embedForm("archivo_1", $formulario_1);

            $archivo_2 = isset($archivo_2) ? $archivo_2 : new ProfesionalArchivo();
            $archivo_2->Profesional = $this->getObject()->getProfesional();
            $formulario_2 = new ProfesionalArchivoFormBackend($archivo_2);
            $this->embedForm("archivo_2", $formulario_2);

            $archivo_3 = isset($archivo_3) ? $archivo_3 : new ProfesionalArchivo();
            $archivo_3->Profesional = $this->getObject()->getProfesional();
            $formulario_3 = new ProfesionalArchivoFormBackend($archivo_3);
            $this->embedForm("archivo_3", $formulario_3);

            $archivo_4 = isset($archivo_4) ? $archivo_4 : new ProfesionalArchivo();
            $archivo_4->Profesional = $this->getObject()->getProfesional();
            $formulario_4 = new ProfesionalArchivoFormBackend($archivo_4);
            $this->embedForm("archivo_4", $formulario_4);

            $archivo_5 = isset($archivo_5) ? $archivo_5 : new ProfesionalArchivo();
            $archivo_5->Profesional = $this->getObject()->getProfesional();
            $formulario_5 = new ProfesionalArchivoFormBackend($archivo_5);
            $this->embedForm("archivo_5", $formulario_5);
        }

        $this->widgetSchema->setLabels(array(
            'name' => __('Título'),
            'user_id' => 'Usuario',
            'incidencia' => __('Tu desaprobación'),
            'plan_accion' => __('Plan de acción'),
            'first_name' => __('Nombre'),
            'last_name_one' => __('Apellido 1'),
            'last_name_two' => __('Apellido 2'),
            'address' => __('Dirección'),
            'email' => __('Correoelectrónico'),
            'numero' => __('Nº'),
            'piso' => __('Piso'),
            'puerta' => __('Puerta'),
            'road_type_id' => __('Tipo de vía'),
            'states_id' => __('Provincia'),
            'city_id' => __('Localidad'),
            'telefono' => __('Teléfono'),
            'profesional_tipo_uno_id' => __('Sector profesional'),
            'profesional_tipo_dos_id' => __('Subsector profesional'),
            'profesional_tipo_tres_id' => __('Actividadprofesional'),
            'description' => __('Recomendación')
        ));

        if ($this->type == 2) {
            $this->widgetSchema->setPositions(array('name', 'user_id', 'profesional_letter_type_id', 'description', 'plan_accion', 'id', 'profesional_letter_estado_id', 'profesional_apro_despro_id', 'Profesional'));
        } else {
            $this->widgetSchema->setPositions(array('name', 'user_id', 'profesional_letter_type_id', 'description', 'plan_accion', 'id', 'profesional_letter_estado_id', 'profesional_apro_despro_id', 'Profesional', 'archivo_1', 'archivo_2', 'archivo_3', 'archivo_4', 'archivo_5'));
        }
    }

    protected function doSave($con = null) {

        //start add code for google map add/edit

        $asProfessionalData = sfContext::getInstance()->getRequest()->getParameter('profesional_letter');

        $this->getObject()->setStatesId($asProfessionalData['Profesional']['states_id']);
        $this->getObject()->setCityId($asProfessionalData['Profesional']['city_id']);

        parent::doSave($con);

        if ($this->getObject()->isNew()) {
            if ($asProfessionalData['profesional_letter_type_id'] == 1)
                ProfesionalLetter::setRecommandationAlert($asProfessionalData, $this->getObject()->getProfesionalId(), $this->getObject()->getId());
            else
                ProfesionalLetter::setDisapprovalAlert($asProfessionalData, $this->getObject()->getProfesionalId(), $this->getObject()->getId());
        }


        $asProfessionalData = sfContext::getInstance()->getRequest()->getParameter('profesional_letter');
        $oProfesionalGMap = Doctrine::getTable('ProfesionalGoogleMap')->findOneByProfesionalId($this->getObject()->getProfesionalId());

        // if exist then update from object
        if ($oProfesionalGMap)
            $oProfesionalGoogleMap = $oProfesionalGMap;
        else
            $oProfesionalGoogleMap = new ProfesionalGoogleMap();

        $oProfesionalGoogleMap->setAddress($asProfessionalData['Profesional']['profesionalGoogleMap']['address']);
        $oProfesionalGoogleMap->setLng($asProfessionalData['Profesional']['profesionalGoogleMap']['lng']);
        $oProfesionalGoogleMap->setLat($asProfessionalData['Profesional']['profesionalGoogleMap']['lat']);
        $oProfesionalGoogleMap->setZoom($asProfessionalData['Profesional']['profesionalGoogleMap']['zoom']);
        $oProfesionalGoogleMap->setProfesionalId($this->getObject()->getProfesionalId());
        $oProfesionalGoogleMap->save();

        //end add code for google map add/edit
    }

}
